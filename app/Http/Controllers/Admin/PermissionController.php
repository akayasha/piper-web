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
use App\Models\Permission;
// use App\Models\Role;

class PermissionController extends Controller
{
    public $view = 'permission.';
    public $route = 'permissions.';
    public $title = 'Izin';
    public $model;

    public function __construct(Permission $model)
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
        $datas = Permission::all();
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
            'guard_name' => 'required',
        ]);

        $input = $request->all();

        // $role = Permission::where('name', 'Super Admin', 'Admin')->first();

        $result = $this->model->create([
            // 'role_id' => $role->uuid,
            'name' => $input['name'],
            'guard_name' => $input['guard_name'],
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
    public function show(string $uuid)
    {
        $data = $this->model->where('uuid', $uuid)->first();
        return view($this->view . 'detail', [
            'data' => $data
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $data = $this->model->where('uuid', $uuid)->first();
        return view($this->view . 'edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'name' => 'required',
            'guard_name' => 'required',
        ]);

        $input = $request->all();

        $result = $this->model->where('uuid', $uuid)->update([
            'name' => $input['name'],
            'guard_name' => $input['guard_name'],
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
    public function destroy(string $uuid)
    {
        $validator = Validator::make(['uuid' => $uuid], [
            'id' => 'required|exists:roles,uuid',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'ID tidak valid'], 400);
        }

        $result = $this->model->where('uuid', $uuid)->forceDelete();
        if ($result) {
            return response()->json(['message' => 'Hapus ' . $this->title . ' Success'], 200);
        }
        return response()->json(['message' => 'Hapus ' . $this->title . ' Gagal'], 500);
    }
}
