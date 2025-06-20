<?php

namespace Database\Seeders;

// Library
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;


// Models
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::whereIn('name', ['super_admin', 'admin_branch', 'employee'])
            ->pluck('uuid', 'name')
            ->toArray();

        $users = [
            [
                'name' => 'Super Admin Piper',
                'email' => 'super.admin@piper.com',
                'phone' => '089516116282',
                'password' => Hash::make('admin123'),
                'role' => 'super_admin',
            ],
            [
                'name' => 'Admin Piper',
                'email' => 'admin@piper.com',
                'phone' => '089516116283',
                'password' => Hash::make('admin123'),
                'role' => 'admin_branch',
            ],
            [
                'name' => 'Employee Piper',
                'email' => 'employee@piper.com',
                'phone' => '089516116281',
                'password' => Hash::make('employee123'),
                'role' => 'employee',
            ]
        ];

        foreach ($users as $user) {
            if (!User::where('email', $user['email'])->exists()) {
                User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'password' => $user['password'],
                    'role_id' => $roles[$user['role']],
                ]);
            }
        }        
    }
}
