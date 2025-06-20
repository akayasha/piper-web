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
use App\Models\RedeemCode;
use App\Models\Branch;

use App\DataTables\VoucherDataTable;

// Helpers
use App\Helpers\GenerateCodeAuto;

class VoucherController extends Controller
{
    public $view = 'voucher.';
    public $route = 'vouchers.';
    public $title = 'Voucher Data';
    public $subtitle = 'List Data Voucher';
    public $model;

    public function __construct(RedeemCode $model)
    {
        View::share('route', $this->route);
        View::share('view', $this->view);
        View::share('title', $this->title);
        View::share('subtitle', $this->subtitle);
        $this->model = $model;
    }

    // USE HELPER TRAITS
    use GenerateCodeAuto;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VoucherDataTable $dataTable)
    {
        $branchs = Branch::all();
        return $dataTable->render($this->view . 'index', [
            'branchs' => $branchs
        ]);

        // $branchs = Branch::all();
        // $branch_id = $request->get('branch_id');

        // return $dataTable->with([
        //     'branch_id' => $branch_id,
        // ])->render($this->view . 'index', [
        //     'branchs' => $branchs,
        //     'selected_branch' => $branch_id,
        // ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branchs = Branch::all();
        return view($this->view . 'create', [
            'branchs' => $branchs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|string|exists:branches,id',
            'code' => 'required',
            'type' => 'required',
            'strip' => 'required|integer|digits_between:1,8',
        ]);

        if (RedeemCode::where('code', $request->code)->exists()) {
            return back()->withErrors(['code' => 'Kode voucher sudah digunakan, silakan gunakan kode lain.'])->withInput();
        }

        $input = $request->all();
        $input['id'] = (string) \Illuminate\Support\Str::uuid();


        $result = $this->model->create([
            'branch_id' => $input['branch_id'],
            'code' => $input['code'],
            'type' => $input['type'],
            'strip' => $input['strip'],
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
        $branchs = Branch::all();
        $data = $this->model->where('id', $id)->first();
        return view($this->view . 'detail', [
            'data' => $data,
            'branchs' => $branchs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branchs = Branch::all();
        $data = $this->model->where('id', $id)->first();
        return view($this->view . 'edit', [
            'data' => $data,
            'branchs' => $branchs
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'branch_id' => 'required|string|exists:branches,id',
            'code' => 'required',
            'type' => 'required',
            'strip' => 'required|integer|digits_between:1,8',
        ]);

        $input = $request->all();

        $result = $this->model->where('id', $id)->update([
            'branch_id' => $input['branch_id'],
            'code' => $input['code'],
            'type' => $input['type'],
            'strip' => $input['strip'],
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
            'id' => 'required|exists:redeem_codes,id',
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

    public function generateCodeAuto(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|string|exists:branches,id',
            'strip' => 'required|integer|digits_between:1,8',
            'total_generate' => 'required|integer',
        ]);

        $input = $request->all();

        $result = [];
        for ($i = 0; $i < $input['total_generate']; $i++) {
            $voucher = new RedeemCode();
            $voucher->branch_id = $input['branch_id'];
            $voucher->code = $this->generateUniqueRedeemCode();
            $voucher->strip = $input['strip'];
            $voucher->type = 'offline';
            if ($voucher->save()) {
                $result[] = $voucher;
            }
        }

        if (count($result) === (int) $input['total_generate']) {
            Alert::success('Genrate Code Auto', 'Successfully generated ' . count($result) . ' vouchers for ' . $this->title);
            return redirect()->route($this->route . 'index');
        } else {
            Alert::error('Failed', 'Failed to generate vouchers. Please try again.');
            return back();
        }
    }
}
