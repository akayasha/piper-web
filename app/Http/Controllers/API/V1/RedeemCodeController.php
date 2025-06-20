<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\RedeemCode;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class RedeemCodeController extends Controller
{
    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|uuid',
            'strip' => 'required|numeric',
            'type' => 'required|in:online,offline',
            'price' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 422,
                'status' => 'Error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Cari branch berdasarkan branch_id
        $branch = Branch::find($request->input('branch_id'));
    
        if (!$branch) {
            return response()->json([
                'status_code' => 404,
                'status' => 'Error',
                'message' => 'Branch tidak ditemukan'
            ], 404);
        }
    
        // Generate kode redeem unik
        do {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $code = substr(str_shuffle($characters), 0, 5); 
        } while (RedeemCode::where('code', $code)->exists());
    
        $redeemCode = RedeemCode::create([
            'code' => $code,
            'type' => $request->input('type'),
            'is_redeemed' => false,
            'branch_id' => $request->input('branch_id'),
            'strip' => $request->input('strip'),
        ]);
    
        $branchName = Str::upper(Str::slug($branch->name, '_')); 
        $date = now()->format('dmy');
        $invoiceNumber = "{$branchName}-{$date}-" . uniqid();
    
        // Buat payment
        $payment = Payment::create([
            'redeem_code_id' => $redeemCode->id,
            'invoice_number' => $invoiceNumber,
            'price' => $request->input('price'),
            'status' => 'pending',
            'payment_method' => 'qris',
            'strip' => $request->input('strip'),
        ]);
    
        return response()->json([
            'status_code' => 200,
            'status' => 'Success',
            'message' => 'Redeem code generated and payment created successfully',
            'redeem_code' => $redeemCode,
            'payment' => $payment
        ], 201);
    }
    

    public function useCode(Request $request, $code)
    {
        $redeemCode = RedeemCode::where('code', $code)->first();

        if (!$redeemCode) {
            return response()->json(['message' => 'Kode redeem tidak ditemukan.'], 404);
        }

        if ($redeemCode->is_redeemed) {
            return response()->json(['message' => 'Kode redeem sudah digunakan.'], 400);
        }

        $redeemCode->is_redeemed = true;
        $redeemCode->redeemed_at = now();
        $redeemCode->save();

        return response()->json([
            'status_code' => 200,
            'status' => 'Success',
            'message' => 'Kode redeem berhasil digunakan.',
            'redeem_code' => $redeemCode
        ], 200);
    }

    public function checkCodeStatus(Request $request, $code)
    {
        $redeemCode = RedeemCode::where('code', $code)->first();

        if (!$redeemCode) {
            return response()->json(['message' => 'Kode redeem tidak ditemukan.'], 404);
        }

        return response()->json([
            'status_code' => 200,
            'status' => 'Success',
            'is_redeemed' => $redeemCode->is_redeemed,
            'redeemed_at' => $redeemCode->is_redeemed ? $redeemCode->redeemed_at : null,
            'message' => $redeemCode->is_redeemed ? 'Kode redeem sudah digunakan.' : 'Kode redeem belum digunakan.'
        ], 200);
    }

    public function getAllRedeemCodes(Request $request)
    {
        $redeemCodes = RedeemCode::all();

        if ($redeemCodes->isEmpty()) {
            return response()->json(['message' => 'Tidak ada kode redeem ditemukan.'], 404);
        }

        return response()->json([
            'status_code' => 200,
            'status' => 'Success',
            'redeem_codes' => $redeemCodes
        ], 200);
    }

    public function getAllBranches(Request $request)
    {
        $branches = Branch::all();

        if ($branches->isEmpty()) {
            return response()->json(['message' => 'Branch Tidak Ditemuka.'], 404);
        }

        return response()->json([
            'status_code' => 200,
            'status' => 'Success',
            'redeem_codes' => $branches
        ], 200);
    }

    public function getBranchByName(Request $request)
    {
        $branchName = $request->input('name');
        $branch = Branch::where('name', 'like', '%' . $branchName . '%')->first();

        if (!$branch) {
            return response()->json(['message' => 'Tidak ada kode redeem ditemukan.'], 404);
        }

        return response()->json([
            'status_code' => 200,
            'status' => 'Success',
            'data' => $branch
        ], 200);
    }

}

