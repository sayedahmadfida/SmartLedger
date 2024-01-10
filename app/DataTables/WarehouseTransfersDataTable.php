<?php

namespace App\DataTables;

use App\Models\Warehouse_transfer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WarehouseTransfersDataTable extends DataTable
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
            ->editColumn('created_at', function ($row){
                return substr($row->created_at, 0, 10);
            })
            ->addColumn('action', '
            <div class="btn-group">
                <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle btn-xs"
                        data-toggle="dropdown">
                        Action
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                       
                    <li><a href="{{ route("stock-transfers.edit", Crypt::encrypt($id)) }}"
                                class="pay_purchase_due"><i class="fa fa-pencil-square"
                                    aria-hidden="true"></i>Edit</a></li>
                        
                        </li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-default{{$id}}"><i class="fa fa-trash"
                                    aria-hidden="true"></i>Delete</a></li>
                    </ul>
                </div>
            </div>

            <div class="modal fade" id="modal-default{{$id}}" style="display: none;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">{{$product_name}}</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-danger text-center">Are you sure!</h2>
                      <p class="text-center text-primary"> Delete {{$product_name}} ?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <form action="{{route("stock-transfers.destroy", Crypt::encrypt($id))}}" method="POST">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>

            ');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Warehouse_transfer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Warehouse_transfer $model)
    {
        return  Warehouse_transfer::where('warehouse_transfers.user_id', auth()->user()->id)->where('warehouse_transfers.admin_id', session('user.admin_id'))
        ->join('warehouses AS w1', 'warehouse_transfers.to_warehouse_id', '=', 'w1.id')
        ->join('warehouses AS w2', 'warehouse_transfers.from_warehouse_id', '=', 'w2.id')
        ->join('product_details AS pd', 'warehouse_transfers.product_id', '=', 'pd.id')
        ->join('products AS p', 'pd.product_id', '=', 'p.id')
        ->select(
            ['warehouse_transfers.id',
            'warehouse_transfers.created_at as created_at', 
            'w1.warehouse_name AS toWarehouse',
            'w2.warehouse_name AS fromWarehouse',
            'pd.quantity as quantity',
            'p.product_name as product_name']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('warehousetransfers-table')
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
            ['name' => 'created_at', 'data' => 'created_at', 'title' => 'Date'],
            ['name' => 'fromWarehouse', 'data' => 'fromWarehouse', 'title' => 'Warehouse(From)'],
            ['name' => 'toWarehouse', 'data' => 'toWarehouse', 'title' => 'Warehouse(To)'],
            ['name' => 'product_name', 'data' => 'product_name', 'title' => 'Product'],
            ['name' => 'quantity', 'data' => 'quantity', 'title' => 'Quantity'],
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
        return 'WarehouseTransfers_' . date('YmdHis');
    }
}
