<?php

namespace App\DataTables;

use App\Models\Payment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Support\Facades\Auth;

class TransactionDataTable extends DataTable
{
    public $view = 'transaction.';

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->filter(function ($query) {
                if ($searchValue = request('search.value')) {
                    $query->where(function ($query) use ($searchValue) {
                        $query->where('invoice_number', 'like', "%{$searchValue}%")
                            ->orWhere('transaction_id', 'like', "%{$searchValue}%")
                            ->orWhere('price', 'like', "%{$searchValue}%")
                            ->orWhere('status', 'like', "%{$searchValue}%")
                            ->orWhere('strip', 'like', "%{$searchValue}%")
                            ->orWhere('payment_method', 'like', "%{$searchValue}%")
                            ->orWhereHas('redeemCode.branch', function ($query) use ($searchValue) {
                                $query->where('name', 'like', "%{$searchValue}%");
                            });
                    });
                }

                if (request()->has('branch_id') && request('branch_id') !== '' && request('branch_id') !== 'all') {
                    $branchId = request('branch_id');
                    $query->whereHas('redeemCode.branch', function ($query) use ($branchId) {
                        $query->where('id', $branchId);
                    });
                }

                 // Add date range filtering
                if (request()->has('start_date') && request('start_date') != '') {
                    $query->whereDate('created_at', '>=', request('start_date'));
                }

                if (request()->has('end_date') && request('end_date') != '') {
                    $query->whereDate('created_at', '<=', request('end_date'));
                }
            });
    }

    /**
     * Get the query source of dataTable.
     *
     * @param \App\Models\Payment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payment $model)
    {
        $session_branch_id = Auth::user()->branch_id;
        if($session_branch_id) {
            return $model->newQuery()
            ->whereHas('redeemCode.branch', function ($query) use ($session_branch_id) {
                $query->where('id', $session_branch_id);
            })
            ->with(['redeemCode.branch'])
            ->orderBy('created_at', 'desc');
        } else {
            return $model->newQuery()->with(['redeemCode.branch'])->orderBy('created_at', 'desc');
        }
    }

    /**
     * Optional method if you want to use the html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('kt_table_transaction')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('invoice_number'),
            Column::make('transaction_id'),
            Column::make('price'),
            Column::make('status'),
            Column::make('strip'),
            Column::make('payment_method'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Transaction_' . date('YmdHis');
    }
}
