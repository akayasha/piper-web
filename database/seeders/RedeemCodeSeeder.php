<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RedeemCode;
use App\Models\Branch;
use Illuminate\Support\Str;

class RedeemCodeSeeder extends Seeder
{
    public function run()
    {
        for ($j = 0; $j < 3; $j++) {
            $branch = Branch::create([
                'id' => (string) Str::uuid(),
                'name' => 'Branch ' . ($j + 1),
                'price' => 10000, 
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            RedeemCode::create([
                'id' => (string) Str::uuid(),
                'code' => rand(10000, 99999),
                'type' => 'online',
                'is_redeemed' => false,
                'branch_id' => Branch::inRandomOrder()->first()->id,
            ]);
        }
    }
}
