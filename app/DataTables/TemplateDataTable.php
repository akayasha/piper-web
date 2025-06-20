<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Yajra\DataTables\Services\DataTable;

class TemplateDataTable extends DataTable
{
    public $view = 'template.';

    /**
     * Build the DataTable class.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable()
    {
        $data = $this->query();
        
        return datatables()
            ->collection($data)
            ->addColumn('action', function ($row) {
                return '<a href="#" class="btn btn-sm btn-primary">View</a>';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return Collection
     */
    public function query(): Collection
    {
        $response = Http::get('http://88.222.212.211:8000/get-all-templates');
        
        if ($response->successful() && isset($response->json()['templates'])) {
            return collect($response->json()['templates'])->map(function ($item) {
                return [
                    'id' => $item['data']['id'] ?? null, 
                    'name' => $item['data']['name'] ?? 'N/A',
                    'template' => $item['data']['template'] ?? 'N/A',
                    'created_at' => $item['data']['created_at'] ?? null,
                    'updated_at' => $item['data']['updated_at'] ?? null,
                ];
            });
        }

        return collect();
    }

    /**
     * Optional method if you want to use the HTML builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('kt_table_template')
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
    public function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('name'),
            Column::make('template'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
