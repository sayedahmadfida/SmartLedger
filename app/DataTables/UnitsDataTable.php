<?php

namespace App\DataTables;

use App\Models\Units;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UnitsDataTable extends DataTable
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
            ->addIndexColumn()
            ->removeColumn('id')
            ->addColumn('action',
                '<div class="___class_+?9___">
                    <button class="btn btn-success btn-xs edit-unit-modal"
                        data-href="{{ route("units.edit", $id) }}" data-container=".units_modal"><i
                            class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-xs delete_units" data-toggle="modal" data-target=".delete_units_modal" data-url="{{ route("units.destroy", $id) }}"><i class="fa fa-trash"></i></button>
                </div>');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Unit $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Units $model)
    {

        return $model->get_units(Auth::id());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('units-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
        // ->dom('Bfrtip')
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
            ['name' => 'DT_RowIndex', 'data' => 'DT_RowIndex', 'title' => 'No', 'searchable' => 'false'],
            'main_name',
            'short_name',
            'action'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Units_' . date('YmdHis');
    }
}
