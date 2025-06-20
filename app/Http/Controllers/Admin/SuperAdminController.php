<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// Library Installer
use RealRashid\SweetAlert\Facades\Alert;

// Models
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class SuperAdminController extends Controller
{
    public $view = 'super-admin.';
    public $route = 'super-admins.';
    public $title = 'Akun Super Admin';
    public $model;

    public function __construct(User $model)
    {
        View::share('route', $this->route);
        View::share('view', $this->view);
        View::share('title', $this->title);
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::where('name', 'super_admin')->first();
        $datas = User::where('role_id', $role->uuid)->get();
        return view($this->view . 'index', [
            'datas' => $datas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->view . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:1|regex:/^(?=.*[A-Z]).*$/',
        ], [
            'password.regex' => 'Password minimal harus Huruf besar 1 karakter.'
        ]);

        $input = $request->all();

        $role = 'super_admin';
        $role = Role::where('name', 'super_admin')->first();

        if (!$role) {
            Alert::error('Error', 'Role Super Admin tidak ditemukan.');
            return back();
        }

        $result = $this->model->create([
            'role_id' => $role->uuid,
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]);

        if ($result) {
            $result->assignRole($role->name);
            Alert::success('Created', 'Create ' . $this->title . ' Success');
            return redirect()->route($this->route . 'index');
        }
        Alert::error('Created', 'Create ' . $this->title . ' Failed');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->model->where('id', $id)->first();
        return view($this->view . 'detail', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->model->where('id', $id)->first();
        return view($this->view . 'edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $input = $request->all();

        $result = $this->model->where('id', $id)->update([
            'name' => $input['name'],
            'email' => $input['email'],
        ]);

        if ($request->password) {
            $this->model->where('id', $id)->update([
                'password' => Hash::make($input['password'])
            ]);
        }

        if ($result) {
            Alert::success('Updated', 'Update ' . $this->title . ' Success');
            return redirect()->route($this->route . 'index');
        }
        Alert::error('Updated', 'Update ' . $this->title . ' Failed');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'ID tidak valid'], 400);
        }

        $result = $this->model->where('id', $id)->forceDelete();
        if ($result) {
            return response()->json(['message' => 'Hapus ' . $this->title . ' Success'], 200);
        }
        return response()->json(['message' => 'Hapus ' . $this->title . ' Gagal'], 500);
    }
}
