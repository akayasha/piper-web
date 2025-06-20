<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

// MODELS
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    public $route = 'categories.';
    public $title = 'Kategori';
    public $model;

    public function __construct(User $model)
    {
        $this->model = $model;
        View::share('route', $this->route);
        View::share('title', $this->title);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createUserGuest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required|string|max:255|unique:users,device_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $input = $request->all();
        $email = $input['device_id'] . '@s.com';
        if ($this->model->where('email', $email)->exists()) {
            return response()->json([
                'code' => 409,
                'message' => 'Email already exists. Please try again.',
            ], 409);
        }

        $result = $this->model->create([
            'device_id' => $input['device_id'],
            'name' => 'guest_' . substr($input['device_id'], 0, 8),
            'email' => $email,
            'is_guest' => 1,
            'role_id' => Role::where('name' , 'guest')->first()->uuid,
            'password' => Hash::make($input['device_id'])
        ]);

        if($result) {
            return response()->json([
                'code' => 200,
                'message' => 'User successfully saved!',
                'data' => $result,
                'device_id' => $input['device_id']
            ], 200);
        }

        return response()->json([
            'code' => 400,
            'message' => 'Failed to save user!',
            'data' => $result
        ], 400);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
