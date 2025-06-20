<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Role;
use App\Models\Payment;
use App\Models\RedeemCode;
use App\Models\Template;
use App\Models\Branch;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $datas = $this->calculate_counter($request);
        return view('dashboard.index' , compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function calculate_counter(Request $request)
    {
        $AUTH = Auth::user();
        
        $roleBranch = Role::where('name', 'admin_branch')->first();
        $roleAdmin = Role::where('name', 'super_admin')->first();
        $filterByBranch = function($query) use ($AUTH) {
            if ($AUTH->branch_id !== null) {
                $query->where('branch_id', $AUTH->branch_id);
            }
        };
    
        $admin_branch = User::where('role_id', $roleBranch->uuid)->tap($filterByBranch)->get();
        $super_admin = User::where('role_id', $roleAdmin->uuid)->tap($filterByBranch)->get();
        $voucher = RedeemCode::tap($filterByBranch)->get();
    
        $transactionQuery = Payment::where('status' , 'success')->whereIn('redeem_code_id', $voucher->pluck('id'));
        if ($AUTH->branch_id !== null) {
            $transaction = $transactionQuery->get()->groupBy('redeem_code.branch_id');
        } else {
            $transaction = $transactionQuery->get();
        }
    
        $available_voucher = RedeemCode::tap($filterByBranch)
                                        ->where('is_redeemed', false)
                                        ->get();
    
        $templateQuery = Template::query();
        if ($AUTH->branch && $AUTH->branch->name !== null) {
            $templateQuery->where('branch', $AUTH->branch->name);
        }
        $template = $templateQuery->get();
                                        
        $branchQuery = Branch::query();
        if ($AUTH->branch_id !== null) {
            $branchQuery->where('id', $AUTH->branch_id);
        }

        $branch = $branchQuery->get();
    
        return [
            'admin_branch' => $admin_branch,
            'super_admin' => $super_admin,
            'transaction' => $transaction,
            'voucher' => $voucher,
            'template' => $template,
            'available_voucher' => $available_voucher,
            'branch' => $branch,
        ];
    }
    

    public function filterData(Request $request)
    {
        $AUTH = Auth::user();

        $year = $request->input('year');
        $month = $request->input('month');
        $timeframe = $request->input('timeframe');

        $filterByBranch = function ($query) use ($AUTH) {
            if ($AUTH->branch_id !== null) {
                $query->where('branch_id', $AUTH->branch_id);
            }
        };

        $query = function ($query) use ($year, $month, $timeframe, $AUTH, $filterByBranch) {
            if ($year) {
                $query->whereYear('created_at', $year);
            }
            if ($month) {
                $monthNumber = date('m', strtotime($month));
                $query->whereMonth('created_at', $monthNumber);
            }
            if ($timeframe === 'Today') {
                $query->whereDate('created_at', now()->toDateString());
            } elseif ($timeframe === 'Last 7 Days') {
                $query->whereDate('created_at', '>=', now()->subDays(7)->toDateString());
            }

            $filterByBranch($query);
        };

        $admin_branch = User::where('role_id', Role::where('name', 'admin_branch')->first()->uuid)
                            ->where($query)
                            ->get();

        $super_admin = User::where('role_id', Role::where('name', 'super_admin')->first()->uuid)
                        ->where($query)
                        ->get();

                        
        $voucher = RedeemCode::where($query)->get();
        $transactionQuery = Payment::where('status', 'success')->whereIn('redeem_code_id', $voucher->pluck('id'));
        if ($AUTH->branch_id !== null) {
            $transaction = $transactionQuery->with('redeemCode')
                ->get()
                ->groupBy(function ($payment) {
                    return $payment->redeemCode->branch_id;
                });
        } else {
            $transaction = $transactionQuery->with('redeemCode')->get();
        }

        $available_voucher = RedeemCode::where('is_redeemed', false)
                                    ->where($query)
                                    ->get();

        $templateQuery = Template::query();
        if ($AUTH->branch && $AUTH->branch->name !== null) {
            $templateQuery->where('branch', $AUTH->branch->name);
        }
        $template = $templateQuery->get();

        $branchQuery = Branch::query();
        if ($AUTH->branch_id !== null) {
            $branchQuery->where('id', $AUTH->branch_id);
        }
        $branch = $branchQuery->get();

        return response()->json([
            'filter_by' => [
                'year' => $year,
                'month' => $month,
                'timeframe' => $timeframe,
            ],
            'success' => true,
            'admin_branch' => $admin_branch,
            'super_admin' => $super_admin,
            'transaction' => $transaction,
            'voucher' => $voucher,
            'available_voucher' => $available_voucher,
            'template' => $template,
            'branch' => $branch,
        ]);
    }
}
