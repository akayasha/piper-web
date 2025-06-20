<?php

namespace Database\Seeders;

use Validator;
use App\Models\Role;

// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run(): void
     {
         $rules = [
             'name' => 'unique:permissions,name',
         ];
 
         $validator1 = Validator::make(['name' => 'authentication'], $rules);
         if ($validator1->fails()) {
             Log::error('Validation failed for permission "authentication": ' . $validator1->errors()->first());
         } else {
             $permission1 = Permission::create(['name' => 'authentication']);
             $superAdminRole = Role::where('name', 'super_admin')->first();
             if ($superAdminRole) {
                 $superAdminRole->givePermissionTo($permission1);
             }
         }
 
         $validator2 = \Validator::make(['name' => 'content_dashboard'], $rules);
         if ($validator2->fails()) {
             \Log::error('Validation failed for permission "content_dashboard": ' . $validator2->errors()->first());
         } else {
             $permission2 = Permission::create(['name' => 'content_dashboard']);
             $superAdminRole = Role::where('name', 'super_admin')->first();
             if ($superAdminRole) {
                 $superAdminRole->givePermissionTo($permission2);
             }
         }
     }
}
