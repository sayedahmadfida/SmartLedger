<?php

namespace App\DataTables;

use App\Models\Customer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CustomersDataTable extends DataTable
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
            ->editColumn('customer_country', function ($row)
            {
                return $row->customer_country.', '.$row->customer_province;
            })
            ->editColumn('created_at', function ($row){
                return Str::substr($row->created_at, 0, 10);
            })
            ->editColumn('updated_at', function ($row){
                return Str::substr($row->updated_at, 0, 10);
            })
            ->editColumn('action',
            '<div class="btn-group">
                <div class="btn-group">
                    <a href="javascript:void(0)" class="btn-primary btn btn-xs dropdown-toggle"  aria-expanded="false" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-option-horizontal"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#" class="pay_purchase_due"><i class="fa fa-money" aria-hidden="true"></i>Payment</a></li>
                        <li><a href="{{ route("cust.show", Crypt::encrypt($id)) }}" class="pay_purchase_due"><i class="fa fa-external-link" aria-hidden="true"></i>View</a></li>
                        <li><a href="{{ route("cust.edit", $id) }}" class="pay_purchase_due"><i class="fa fa-pencil-square" aria-hidden="true"></i>Edit</a></li>
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
                      <h4 class="modal-title"> {{$customer_name}}</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-danger text-center">Are you sure!</h2>
                      <p class="text-center"> Delete {{$customer_name.": ". $customer_country}} ?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <form action="{{route("cust.destroy", Crypt::encrypt($id))}}" method="POST">
                            @csrf
                            @method("delete")
                            <input type="hidden" value="{{Crypt::encrypt($id)}}" name="customer_id" />
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
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
    {
        $customers = Customer::where('user_id', Auth::id())
        ->select(['id', 'customer_name', 'customer_country', 'customer_province', 'customer_village', 'identity_card', 'created_at', 'updated_at']);
        return $customers;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('customers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['excel', 'csv'],
                    ])
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
            ['name' => 'customer_name', 'data' => 'customer_name', 'title' => 'Name'],
            ['name' => 'customer_country', 'data' => 'customer_country', 'title' => 'Customer Address'],
            ['name' => 'customer_village', 'data' => 'customer_village', 'title' => 'Shop No#'],
            ['name' => 'identity_card', 'data' => 'identity_card', 'title' => 'ID No#'],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => 'Date'],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => 'Date'],
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
        return 'Customers_' . date('YmdHis');
    }
}
