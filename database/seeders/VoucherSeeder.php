<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RedeemCode;
use App\Models\Branch;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil satu branch_id secara acak untuk setiap kode redeem
        $branch = Branch::inRandomOrder()->first();

        if (!$branch) {
            $this->command->info("No branches found. Please seed Branch data first.");
            return;
        }

        $data = [
            [
                'branch_id' => $branch->id,
                'code' => '12345',
                'type' => 'offline',
                'strip' => 4,
                'is_redeemed' => false,
                'redeemed_at' => null,
            ],
            [
                'branch_id' => $branch->id,
                'code' => '54321',
                'type' => 'offline',
                'strip' => 8,
                'is_redeemed' => false,
                'redeemed_at' => null,
            ],
        ];

        foreach ($data as $voucher) {
            RedeemCode::firstOrCreate(
                ['code' => $voucher['code']],
                $voucher
            );
        }
    }
}
