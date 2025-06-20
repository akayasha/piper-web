<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Branch;
use App\Models\PriceBranch;
use App\Models\Role;
use App\Models\User;

use App\DataTables\BranchDataTable;
use App\DataTables\BranchPicDataTable;

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
        $priceBranch = new \stdClass(); // Contoh data dummy
        $priceBranch->price = null; // Default value
        $role = Role::where('name' , 'admin_branch')->first();
        $users = User::where('role_id' , $role->uuid)->get();
        $price_bracnhes = PriceBranch::all();
        return view($this->view . '.create' , compact('priceBranch'), [
            'users' => $users,
            'price_bracnhes' => $price_bracnhes
        ]);
     }
     

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
        
        ]);
        // dd("validated", $request->input('price'));
      

        DB::beginTransaction();
        try {
            // dd($validated['strip']);
            // Simpan data branch
            $branch = Branch::create([
                'id' => \Illuminate\Support\Str::uuid(),
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
            ]);
    
            // Simpan data price_branches
            $priceBranches = [];
            // dd($priceBranches);
            foreach ($request->input('price') as $key => $price) {
                $priceBranches[] = [
                    'branch_id' => $branch->id,
                    'strip' => $key+1,
                    'price' => $price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            PriceBranch::insert($priceBranches);
    
            DB::commit();
    
            Alert::success('Success', 'Branch and Price Branches successfully created.');
            return redirect()->route($this->route . 'index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Failed to create Branch and Price Branches. ' . $e->getMessage());
            return back()->withInput();
        }
    }
    

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'price' => 'required|integer',
    //         'phone' => 'required|string',
    //         'address' => 'required|string',
    //     ]);

    //     $input = $request->all();
    //     $input['id'] = (string) \Illuminate\Support\Str::uuid();

    //     $role = Role::where('name' , 'admin_branch')->first();
    //     $users = User::where('role_id' , $role->uuid)->get();

    //     $result = $this->model->create([
    //         'name' => $input['name'],
    //         'price' => $input['price'],
    //         'phone' => $input['phone'],
    //         'address' => $input['address'],
    //     ]);

    //     if ($result) {
    //         Alert::success('Created', 'Create ' . $this->title . ' Success');
    //         return redirect()->route($this->route . 'index');
    //     }
        
    //     Alert::error('Created', 'Create ' . $this->title . ' Failed');
    //     return back();
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->model->where('id', $id)->with('priceBranches')->first();
        $role = Role::where('name' , 'admin_branch')->first();
        $users = User::where('role_id' , $role->uuid)->get();
        // $data = PriceBranch::findOrFail($id);
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
        $data = $this->model->where('id', $id)->with('priceBranches')->first();
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
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // Update Branch
            $branch = $this->model->findOrFail($id);
            $branch->update([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
            ]);

            // Hapus price lama
            PriceBranch::where('branch_id', $id)->delete();

            // Simpan data price baru
            $priceBranches = [];
            foreach ($request->input('price') as $key => $price) {
                $priceBranches[] = [
                    'branch_id' => $branch->id,
                    'strip' => $key + 1,
                    'price' => $price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            PriceBranch::insert($priceBranches);

            DB::commit();
            Alert::success('Success', 'Branch updated successfully');
            return redirect()->route($this->route . 'index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Failed to update branch');
            return back()->withInput();
        }
    }


    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'phone' => 'required|string|max:100',
    //         'address' => 'required|string', 
    //     ]);

    //     $input = $request->all();
    //     $role = Role::where('name' , 'admin_branch')->first();
    //     $users = User::where('role_id' , $role->uuid)->get();

    //     $result = $this->model->where('id', $id)->update([
    //         'name' => $input['name'],
    //         'phone' => $input['phone'],
    //         'address' => $input['address'],
    //     ]);

    //     if ($result) {
    //         Alert::success('Updated', 'Update ' . $this->title . ' Success');
    //         return redirect()->route($this->route . 'index');
    //     }
    //     Alert::error('Updated', 'Update ' . $this->title . ' Failed');
    //     return back();
    // }

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

    // Add ons Function

    public function BranchPic(BranchPicDataTable $dataTable, $branch_id) 
    {
        return $dataTable
        ->where('branch', $branch_id)
        ->render('branch.detail');
    }

}
