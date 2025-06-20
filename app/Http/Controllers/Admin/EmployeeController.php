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
use App\Models\Branch;
use App\Models\Permission;

use App\DataTables\UsersDataTable;

class EmployeeController extends Controller
{
    public $view = 'employee.';
    public $route = 'employees.';
    public $title = 'Employee Account';
    public $subtitle = 'List Data Employee Account';
    public $model;

    public function __construct(User $model)
    {
        View::share('route', $this->route);
        View::share('view', $this->view);
        View::share('title', $this->title);
        View::share('subtitle', $this->subtitle);
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->with(['role' => 'employee'])->render($this->view . 'index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view($this->view . 'create' , compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:1|regex:/^(?=.*[A-Z]).*$/',
        ], [
            'password.regex' => 'Password minimal harus Huruf besar 1 karakter.'
        ]);

        $input = $request->all();

        $role = Role::where('name', 'employee')->first();

        if (!$role) {
            Alert::error('Error', 'Role Employee Branch tidak ditemukan.');
            return back();
        }

        $result = $this->model->create([
            'branch_id' => $input['branch_id'],
            'role_id' => $role->uuid,
            'name' => $input['name'],
            'phone' => $input['phone'],
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
        $branches = Branch::all();
        $data = $this->model->where('id', $id)->first();
        return view($this->view . 'detail', [
            'data' => $data,
            'branches' => $branches
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branches = Branch::all();
        $data = $this->model->where('id', $id)->first();
        return view($this->view . 'edit', [
            'data' => $data,
            'branches' => $branches
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'branch_id' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ]);

        $input = $request->all();

        $result = $this->model->where('id', $id)->update([
            'branch_id' => $input['branch_id'],
            'name' => $input['name'],
            'phone' => $input['phone'],
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
            return response()->json(['success' => false, 'message' => 'Invalid ID'], 400);
        }
        $result = $this->model->where('id', $id)->forceDelete();
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Successfully deleted ' . $this->title], 200);
        }
        return response()->json(['success' => false, 'message' => 'Failed to delete ' . $this->title], 500);
    }
}
