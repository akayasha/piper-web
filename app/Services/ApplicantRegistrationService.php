<?php

namespace App\Services;

use App\Models\User;
use App\Models\Applicant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class ApplicantRegistrationService
{
    public function registerApplicant(array $data)
    {
        // Validate the data
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20|unique:users',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
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
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'],
            ]);

            // Assign the applicant role to the user
            $role = Role::where('name', 'applicant')->first();
            if ($role) {
                $user->assignRole($role);
            } else {
                throw new \Exception("Role 'applicant' does not exist.");
            }

            // Create the applicant profile
            Applicant::create([
                'user_id' => $user->id,
                'company_name' => $data['company_name'],
                'address' => $data['address'],
                'gender' => $data['gender'],
                'phone' => $data['phone'],
            ]);

            // Commit transaction
            DB::commit();

            return response()->json(['user' => $user, 'role' => 'applicant'], 201);

        } catch (\Exception $e) {
            // Rollback transaction in case of error
            DB::rollBack();
            return response()->json(['error' => 'Registration failed, please try again.'], 500);
        }
    }
}
