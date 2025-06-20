<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

// Library Installer
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

// Models
use App\Models\Payment;
use App\Models\Branch;

// DataTable
use App\DataTables\TransactionDataTable;

// Export
use App\Exports\Transaction\TemplateExport;

class TransactionController extends Controller
{
    public $view = 'transaction.';
    public $route = 'transactions.';
    public $title = 'Transaction';
    public $subtitle = 'List Data Transaction';
    public $model;

    public function __construct(Payment $model)
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
    public function index(TransactionDataTable $dataTable)
    {
        $payments = $this->model->all();
        $branches = Branch::get();
        return $dataTable->render($this->view . 'index', compact('payments' , 'branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

    public function export(Request $request)
    {
        $query = $this->model->query();
        
        // Apply the same filters as in the datatable
        if ($request->has('branch_id') && $request->branch_id !== '' && $request->branch_id !== 'all') {
            $query->whereHas('redeemCode.branch', function ($q) use ($request) {
                $q->where('id', $request->branch_id);
            });
        }
        
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        $dateTime = Carbon::now()->format('d-M-Y-H:i');
        $filename = 'list-transaction-' . $dateTime . '.xlsx';
        
        return Excel::download(new TemplateExport($query), $filename);
    }

    // public function export()
    // {
    //     $dateTime = Carbon::now()->format('d-M-Y-H:i');
    //     $filename = 'list-transaction-' . $dateTime . '.xlsx';
    //     return Excel::download(new TemplateExport, $filename);
    // }
}
