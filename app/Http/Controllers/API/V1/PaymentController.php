<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Branch;
use App\Models\Payment;
use Midtrans\Transaction;
use App\Models\RedeemCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Events\PaymentStatusUpdated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class PaymentController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'redeem_code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $redeemCode = RedeemCode::where('code', $request->input('redeem_code'))->first();
        if (!$redeemCode) {
            return response()->json(['message' => 'Redeem code not found.'], 404);
        }

        $payment = Payment::where('redeem_code_id', $redeemCode->id)->first();
        if (!$payment) {
            return response()->json(['message' => 'No payment found for this redeem code.'], 404);
        }

        if ($payment->status === 'completed') {
            return response()->json(['message' => 'Payment already processed.'], 409); 
        }

        $payload = [
            'payment_type' => 'QRIS',
            'transaction_details' => [
                'order_id' => $payment->invoice_number,
                'gross_amount' => $payment->price,
            ],
            'qris' => [
                'additional_param' => [
                    'expiry_time' => '3m',
                ],
            ],
        ];

        Log::info('Sending payload to Midtrans:', $payload);

        $serverKey = config('services.midtrans.serverKey'); 
        if (!$serverKey) {
            Log::error('Midtrans Production Server Key is not set.');
            return response()->json(['message' => 'Server configuration error.'], 500);
        }

        try {
            $resp = Http::withBasicAuth($serverKey, '')
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->post('https://api.midtrans.com/v2/charge', $payload); 
        } catch (\Exception $e) {
            Log::error('Midtrans Request Failed:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Payment processing failed.'], 500);
        }

        Log::info('Received response from Midtrans:', [
            'status' => $resp->status(),
            'body' => $resp->body(),
        ]);

        if ($resp->status() == 201 || $resp->status() == 200) {
            $actions = $resp->json('actions');

            if (empty($actions)) {
                return response()->json(['message' => $resp['status_message'] ?? 'Unknown error'], 500);
            }

            $transactionId = $resp->json('transaction_id');
            $payment->update(['transaction_id' => $transactionId]);

            event(new PaymentStatusUpdated($payment));

            $actionMap = [];
            foreach ($actions as $action) {
                $actionMap[$action['name']] = $action['url'];
            }

            return response()->json([
                'status_code' => 200,
                'status' => 'Success',
                'message' => 'QR Code Payment Successfully Created',
                'data' => [
                    'payment_id' => $payment->id,
                    'redeem_code' => $redeemCode->code,
                    'invoice_number' => $payment->invoice_number,
                    'transaction_id' => $payment->transaction_id,
                    'price' => $payment->price,
                    'strip' => $payment->strip,
                    'status' => $payment->status,
                    'payment_method' => 'qris',
                    'qr' => $actionMap['generate-qr-code'] ?? null,
                    'expires_in' => 180
                ]
            ], 201);
        }

        return response()->json(['message' => $resp->body()], 500);
    }

    public function checkPaymentStatus($invoiceNumber)
    {
        $serverKey = config('services.midtrans.serverKey');
        
        if (!$serverKey) {
            Log::error('Midtrans Server Key is not set.');
            return response()->json(['message' => 'Server configuration error.'], 500);
        }
        
        $payment = Payment::where('invoice_number', $invoiceNumber)->first();
        
        if (!$payment) {
            Log::error("Payment with invoice_number {$invoiceNumber} not found.");
            return response()->json(['message' => 'Payment not found.'], 404);
        }
        
        try {
            $resp = Http::withBasicAuth($serverKey, '')
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->get("https://api.midtrans.com/v2/{$invoiceNumber}/status"); 
            } catch (\Exception $e) {
            Log::error('Midtrans Request Failed:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to fetch payment status.'], 500);
        }
        
        Log::info('Received payment status from Midtrans:', [
            'status' => $resp->status(),
            'body' => $resp->body(),
        ]);
        
        if ($resp->successful()) {
            $data = $resp->json();
            $status = $data['transaction_status'] ?? 'unknown';
        
            if (in_array($status, ['capture', 'settlement'])) {
                $payment->status = 'success';
                $payment->payment_method = 'qris';
            } elseif ($status === 'pending') {
                $payment->status = 'pending';
            } elseif ($status === 'expire') {
                $payment->status = 'expired';
            } elseif (in_array($status, ['failed', 'cancel'])) {
                $payment->status = 'failed';
            }
        
            $payment->save();
            
            event(new PaymentStatusUpdated($payment));
    
            return response()->json([
                'status_code' => $resp->status(),
                'status' => 'Success',
                'message' => 'Payment status retrieved and updated successfully.',
                'data' => [
                    'transaction_time' => $data['transaction_time'] ?? null,
                    'gross_amount' => $data['gross_amount'] ?? null,
                    'currency' => $data['currency'] ?? null,
                    'order_id' => $data['order_id'] ?? null,
                    'payment_type' => $data['payment_type'] ?? null,
                    'status_code' => $data['status_code'] ?? null,
                    'transaction_id' => $data['transaction_id'] ?? null,
                    'status' => $payment->status, 
                    'expiry_time' => $data['expiry_time'] ?? null,
                    'merchant_id' => $data['merchant_id'] ?? null,
                ],
            ], $resp->status());
        }
        
        return response()->json(['message' => $resp->body()], $resp->status());
    }    
   
    public function getPaymentBrach($branchId, $strip)
    {
        $branch = Branch::where('id', $branchId)->first();

        if (!$branch) {
            return response()->json(['message' => 'Branch not found.'], 404);
        }

        $totalPrice = $branch->price * $strip;

        return response()->json([
            'branch_id' => $branch->id,
            'name' => $branch->name,
            'price_per_strip' => $branch->price,
            'total_price' => $totalPrice,
        ], 200);
    }

    public function getPayments()
    {
        $payments = Payment::all(); 

        return response()->json([
            'status_code' => 200,
            'status' => 'Success',
            'data' => $payments
        ], 200);
    }

    public function deleteByInvoice($invoiceNumber)
    {
        $payment = Payment::where('invoice_number', $invoiceNumber)->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment not found.'], 404);
        }

        try {
            $payment->delete();

            return response()->json([
                'status_code' => 200,
                'status' => 'Success',
                'message' => 'Payment successfully deleted.',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to delete payment:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to delete payment.'], 500);
        }
    }


}

