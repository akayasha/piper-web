<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Branch;
use App\Models\User;

class BranchSeeder extends Seeder
{
    public function run()
    {
        Branch::create([
            'id' => '2db2d190-7c3e-4fdf-ac11-f2a9a8689701',
            'name' => 'Branch 1',
            // 'price' => 10000,
            'phone' => '1234567890',
            'address' => 'Alamat untuk Branch 1',
        ]);

        Branch::create([
            'id' => '2db2d190-7c3e-4fdf-ac11-f2a9a8689702',
            'name' => 'Branch 2',
            // 'price' => 20000,
            'phone' => '0987654321',
            'address' => 'Alamat untuk Branch 1',
        ]);

        Branch::create([
            'id' => '2db2d190-7c3e-4fdf-ac11-f2a9a8689703',
            'name' => 'Branch 3',
            // 'price' => 40000,
            'phone' => '348877278',
            'address' => 'Alamat untuk Branch 2',
        ]);

        Branch::create([
            'id' => '2db2d190-7c3e-4fdf-ac11-f2a9a8689704',
            'name' => 'Branch 4',
            // 'price' => 20000,
            'phone' => '33993439',
            'address' => 'Alamat untuk Branch 3',
        ]);

        Branch::create([
            'id' => '2db2d190-7c3e-4fdf-ac11-f2a9a8689705',
            'name' => 'Branch 5',
            // 'price' => 70000,
            'phone' => '33993434449',
            'address' => 'Alamat untuk Branch 4',
        ]);

        Branch::create([
            'id' => '2db2d190-7c3e-4fdf-ac11-f2a9a8689706',
            'name' => 'Bento Pekansari',
            // 'price' => 1,
            'phone' => '089876543211',
            'address' => 'Bento Pekansari',
        ]);
    }
}
