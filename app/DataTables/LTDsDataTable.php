<?php

namespace App\DataTables;

use App\Models\Ltd_registration;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;


class LTDsDataTable extends DataTable
{
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
            ->addColumn('action', 'ltds.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Ltd_registration $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ltd_registration $model)
    {
        $ltds = $model->where('user_id', Auth::id())
        ->select(['id', 'ltd_name', 'ltd_country', 'ltd_province', 'ltd_street', 'ltd_shop']);
        return $ltds;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('ltds-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name' => 'ltd_name', 'data' => 'ltd_name', '']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'LTDs_' . date('YmdHis');
    }
}
