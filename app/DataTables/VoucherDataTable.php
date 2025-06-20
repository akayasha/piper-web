<?php

namespace App\DataTables;

use App\Models\RedeemCode;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Support\Facades\Auth;

class VoucherDataTable extends DataTable
{
    public $view = 'voucher.';

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->filter(function ($query) {
                if ($searchValue = request('search.value')) {
                    $query->where(function ($query) use ($searchValue) {
                        $query->where('code', 'like', "%{$searchValue}%")
                            ->orWhere('type', 'like', "%{$searchValue}%")
                            ->orWhere('strip', 'like', "%{$searchValue}%")
                            ->orWhere('is_redeemed', 'like', "%{$searchValue}%")
                            ->orWhereHas('branch', function ($query) use ($searchValue) {
                                $query->where('name', 'like', "%{$searchValue}%");
                            });
                    });
                }

                if (request()->has('branch_id') && request('branch_id') !== '' && request('branch_id') !== 'all') {
                    $branchId = request('branch_id');
                    $query->whereHas('branch', function ($query) use ($branchId) {
                        $query->where('id', $branchId);
                    });
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RedeemCode $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RedeemCode $model)
    {
        $session_branch_id = Auth::user()->branch_id;
        if ($session_branch_id) {
            return $model->newQuery()->where('branch_id', $session_branch_id)->with('branch')->orderBy('created_at', 'desc');
        } else {
            return $model->newQuery()->with('branch')->orderBy('created_at', 'desc');
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('kt_table_voucher')
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
     * Get columns definition.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('branch_id'),
            Column::make('code'),
            Column::make('type'),
            Column::make('strip'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Voucher_' . date('YmdHis');
    }
}
