<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BranchPicDataTable extends DataTable
{
    protected $branch_id;

    /**
     * Set filter for branch dynamically.
     */
    public function where(string $column, mixed $value): static
    {
        if ($column === 'branch') {
            $this->branch_id = $value;
        }
        return $this;
    }

    /**
     * Build the DataTable class.
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {
                return '<a href="#" class="btn btn-sm btn-primary">View</a>';
            });
    }

    /**
     * Get the query source for the DataTable.
     */
    public function query(User $model)
    {
        return $model->newQuery()->where('branch_id', $this->branch_id)->orderBy('created_at', 'desc');
    }

    /**
     * Define the HTML structure for the DataTable.
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('template-table')
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
     * Define the columns for the DataTable.
     */
    public function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('template'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Template_' . date('YmdHis');
    }
}
