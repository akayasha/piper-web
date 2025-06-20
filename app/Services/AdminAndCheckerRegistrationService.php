<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AdminAndCheckerRegistrationService
{
    public function registerAdmin(array $data)
    {
        return $this->registerUserWithRole($data, 'admin');
    }

    public function registerChecker(array $data)
    {
        return $this->registerUserWithRole($data, 'checker');
    }

    private function registerUserWithRole(array $data, string $roleName)
    {
        // Validate the data
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Create the user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
            ]);

            // Assign role to the user
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $user->assignRole($role);
            } else {
                throw new \Exception("Role '{$roleName}' does not exist.");
            }

            // Commit transaction
            DB::commit();

            return response()->json(['user' => $user, 'role' => $roleName], 201);

        } catch (\Exception $e) {
            // Rollback transaction in case of error
            DB::rollBack();
            return response()->json(['error' => 'Registration failed, please try again.'], 500);
        }
    }
}
