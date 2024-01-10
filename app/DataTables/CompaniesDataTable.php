<?php

namespace App\DataTables;

use App\Models\Company;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class CompaniesDataTable extends DataTable
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
            ->addColumn('Company', function($row){
                return $row->company_name;
            })
            ->addColumn('Address', function ($row){
                return $row->company_country.', '.$row->company_province;
            })
            ->addColumn('Phone', function($row){
                return $row->company_phone;
            })
            ->addColumn('Email', function($row){
                return $row->company_email;
            })
            ->addColumn('Date', function($row){
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
                        <li><a href="{{ route("brand.show", Crypt::encrypt($id))}}" class="pay_purchase_due"><i class="fa fa-external-link"
                                    aria-hidden="true"></i>View</a></li>
                        <li><a href="{{ route("brand.edit", Crypt::encryptString($id)) }}"
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
                      <h4 class="modal-title">{{$company_name}}</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-danger text-center">Are you sure!</h2>
                      <p class="text-center"> Delete {{$company_name}} ?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <form action="{{route("brand.destroy", Crypt::encrypt($id))}}" method="POST">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>'
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Company $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Company $model)
    {
        $com_info = Company::where('user_id', '=', Auth::id())
        ->select('id', 'company_name', 'company_phone', 'company_country', 'company_province', 'company_email', 'created_at');
        return $com_info;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('companies-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
            // ->buttons(
            //     Button::make('create'),
            //     Button::make('export'),
            //     Button::make('print'),
            //     Button::make('reset'),
            //     Button::make('reload')
            // );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'Company',
            'Address',
            'Phone',
            'Email',
            'Date',
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
        return 'Companies_' . date('YmdHis');
    }
}
