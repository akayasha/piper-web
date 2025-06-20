<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

// Models
use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use App\DataTables\BranchDataTable;

class BranchController extends Controller
{
    public $view = 'branch.';
    public $route = 'branchs.';
    public $title = 'Branch';
    public $subtitle = 'List Data Branch';
    public $model;

    public function __construct(Branch $model)
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
    public function index(BranchDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
     {
        $role = Role::where('name' , 'admin_branch')->first();
        $users = User::where('role_id' , $role->uuid)->get();
        return view($this->view . '.create' , [
            'users' => $users
        ]);
     }
     


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|string|exists:users,id',
            'name' => 'required',
            'price' => 'required|integer',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $input = $request->all();
        $input['id'] = (string) \Illuminate\Support\Str::uuid();

        $role = Role::where('name' , 'admin_branch')->first();
        $users = User::where('role_id' , $role->uuid)->get();

        $result = $this->model->create([
            'user_id' => $input['user_id'],
            'name' => $input['name'],
            'price' => $input['price'],
            'phone' => $input['phone'],
            'address' => $input['address'],
        ]);

        if ($result) {
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
        $role = Role::where('name' , 'admin_branch')->first();
        $users = User::where('role_id' , $role->uuid)->get();
        return view($this->view . 'detail', [
            'data' => $data,
            'users' => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->model->where('id', $id)->first();
        $role = Role::where('name' , 'admin_branch')->first();
        $users = User::where('role_id' , $role->uuid)->get();
        return view($this->view . 'edit', [
            'data' => $data,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'nullable|string|exists:users,id',
            'name' => 'required|string|max:255',
            'price' => 'required|integer', 
            'phone' => 'required|string|max:100',
            'address' => 'required|string', 
        ]);

        $input = $request->all();
        $role = Role::where('name' , 'admin_branch')->first();
        $users = User::where('role_id' , $role->uuid)->get();

        $result = $this->model->where('id', $id)->update([
            'user_id' => $input['user_id'],
            'name' => $input['name'],
            'price' => $input['price'],
            'phone' => $input['phone'],
            'address' => $input['address'],
        ]);

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
            'id' => 'required|exists:branches,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid ID'], 400);
        }

        $result = $this->model->where('id', $id)->forceDelete();
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Successfully deleted the branch'], 200);
        }
        
        return response()->json(['success' => false, 'message' => 'Failed to delete the branch'], 500);
    }

}
