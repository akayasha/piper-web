<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\RedeemCode;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua redeem codes yang tersedia
        $redeemCodes = RedeemCode::all();

        $data = [
            [
                'invoice_number' => 'INV-001',
                'transaction_id' => 'TRX-001',
                'price' => 1000.00,
                'status' => 'pending',
                'strip' => 4,
                'payment_method' => 'Transfer bank',
            ],
            [
                'invoice_number' => 'INV-002',
                'transaction_id' => 'TRX-002',
                'price' => 1500.00,
                'status' => 'completed',
                'strip' => 8,
                'payment_method' => 'QRIS',
            ],
        ];

        foreach ($data as $transaction) {
            // Pilih redeem_code_id secara acak
            $redeemCode = $redeemCodes->random();
            $transaction['redeem_code_id'] = $redeemCode->id;

            Payment::firstOrCreate(
                ['invoice_number' => $transaction['invoice_number']],
                $transaction
            );
        }
    }
}
