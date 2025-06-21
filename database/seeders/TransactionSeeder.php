<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\RedeemCode;
use App\Models\Branch;

class TransactionSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        // Ambil cabang Bento Pekansari
        $bentoBranch = Branch::where('name', 'Bento Pekansari')->first();

        if (!$bentoBranch) {
            $this->command->warn('Cabang Bento Pekansari tidak ditemukan. Pastikan telah dibuat di BranchSeeder.');
            return;
        }

        // Ambil semua redeem codes yang tersedia
        $redeemCodes = RedeemCode::all();

        if ($redeemCodes->isEmpty()) {
            $this->command->warn('Tidak ada redeem codes yang tersedia. Tambahkan redeem codes terlebih dahulu.');
            return;
        }

        $data = [
            [
                'invoice_number' => 'INV-002',
                'transaction_id' => 'TRX-002',
                'price' => 1500.00,
                'status' => 'Success',
                'strip' => 8,
                'payment_method' => 'QRIS',
            ],
            [
                'invoice_number' => 'INV-001',
                'transaction_id' => 'TRX-001',
                'price' => 1000.00,
                'status' => 'pending',
                'strip' => 4,
                'payment_method' => 'Transfer bank',
            ],
            [
                'invoice_number' => 'INV-003',
                'transaction_id' => 'TRX-003',
                'price' => 200.00,
                'status' => 'Expired',
                'strip' => 2,
                'payment_method' => 'QRIS',
            ],
        ];

        foreach ($data as $transaction) {
            // Pilih redeem_code_id secara acak
            $redeemCode = $redeemCodes->random();
            $transaction['redeem_code_id'] = $redeemCode->id;
            
            // Tetapkan branch_id ke Bento Pekansari
            $transaction['branch_id'] = $bentoBranch->id;

            // Simpan ke database
            Payment::firstOrCreate(
                ['invoice_number' => $transaction['invoice_number']],
                $transaction
            );
        }

        $this->command->info('Seeder transaksi berhasil dijalankan dengan cabang Bento Pekansari.');
    }
}
