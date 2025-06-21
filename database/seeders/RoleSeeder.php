<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin_branch',
                'guard_name' => 'web',
            ]
        ];


        foreach ($roles as $role) {
            if (array_key_exists('name', $role) && !Role::where('name', $role['name'])->exists()) {
                Role::create($role);
            }
        }

        $superAdminRole = Role::where('name', 'super_admin')->first();
        $permission = Permission::where('name', 'authentication')->first();

        if ($superAdminRole && $permission) {
            $superAdminRole->givePermissionTo($permission);
        }

        $AdminRole = Role::where('name', 'admin_branch')->first();
        $permission = Permission::where('name', 'authentication')->first();

        if ($AdminRole && $permission) {
            $AdminRole->givePermissionTo($permission);
        }
    }
}
