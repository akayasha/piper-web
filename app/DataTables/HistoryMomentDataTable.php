<?php

namespace App\DataTables;

use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class HistoryMomentDataTable extends DataTable
{
    protected $fileCollection;

    /**
     * Inject data to the DataTable instance.
     *
     * @param array|string $key
     * @param mixed|null $value
     * @return static
     */
    public function with(array|string $key, mixed $value = null): static
    {
        if ($key === 'fileCollection') {
            $this->fileCollection = $value;
        }

        return parent::with($key, $value);
    }

    /**
     * Build the DataTable class.
     *
     * @param Collection $collection
     */
    public function dataTable()
    {
        return datatables()
            ->collection($this->fileCollection)
            ->addColumn('action', function ($row) {
                return '<a href="/file/view/' . $row['id'] . '" class="btn btn-sm btn-primary">View</a>
                        <a href="/file/download/' . $row['id'] . '" class="btn btn-sm btn-success">Download</a>';
            })
            ->rawColumns(['action']);
    }

    /**
     * Optional method if you want to use the HTML builder.
     */
    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->setTableId('historymoment-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the DataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('File ID'),
            Column::make('name')->title('File Name'),
            Column::make('mimeType')->title('File Type'),
            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'HistoryMoment_' . date('YmdHis');
    }
}
