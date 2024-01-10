<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
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
            ->editColumn('main_name', function ($row) {
                return $row->main_name . ' (' . $row->short_name . ') ';
            })
            ->editColumn('created_at', function ($row) {
                return Str::substr($row->created_at, 0, 10);
            })
            ->addColumn('action', ' <div class="btn-group">
                <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown">
                        Action
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#" class="pay_purchase_due"><i class="fa fa-external-link" aria-hidden="true"></i>View</a></li>
                        <li><a href="{{ route("productList.edit", $id) }}" class="pay_purchase_due"><i class="fa fa-pencil-square" aria-hidden="true"></i>Edit</a></li>
                        <li><a href="#" class="delete-customer"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                    </ul>
                </div>');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $products = Product::where('products.user_id', Auth::id())->where('products.admin_id', session('user.admin_id'))
            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
            ->join('units', 'products.unite_id', '=', 'units.id')
            ->select(['products.id', 'products.product_name', 'units.main_name', 'units.short_name',
                'sub_categories.sub_category_name', 'products.created_at as created_at']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('products-table')
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
            ['name' => 'product_name', 'data' => 'product_name', 'title' => 'Product Name'],
            ['name' => 'sub_category_name', 'data' => 'sub_category_name', 'title' => 'Category'],
            ['name' => 'main_name', 'data' => 'main_name', 'title' => 'Unit'],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => 'Date'],
            'action',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Products_' . date('YmdHis');
    }
}
