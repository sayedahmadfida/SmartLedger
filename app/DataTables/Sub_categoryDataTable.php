<?php

namespace App\DataTables;

use App\Models\Sub_category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class Sub_categoryDataTable extends DataTable
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
            ->addColumn('action', '<td>
            <a class="ml text-success"
                href="{{ route("sub-category.edit", Crypt::encrypt($id)) }}" data-container=".sub_category_modal">
                <i class="fa fa-pencil"></i></a>
                
                <a href="#" class="text-danger ml-2" data-toggle="modal" data-target="#modal-default{{$id}}"><i class="fa fa-trash"
                aria-hidden="true"></i></a>
            
            
            
            </a>
        
            <div class="modal fade" id="modal-default{{$id}}" style="display: none;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">{{$sub_category_name}}</h4>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-danger text-center">Are you sure!</h2>
                      <p class="text-center"> Delete  {{$sub_category_name}} ?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <form action="{{route("sub-category.destroy", Crypt::encrypt($id))}}" method="POST">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
        </td>');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Sub_category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sub_category $model)
    {
        return Sub_category::join('categories', 'sub_categories.category_id', '=', 'categories.id')
        ->where('sub_categories.user_id', Auth::id())
        ->select('categories.category_name', 'sub_categories.sub_category_name', 'sub_categories.id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('sub_category-table')
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
            ['name' => 'category_name', 'data' => 'category_name', 'title' => 'Category', 'searchable' => 'false'],
            ['name' => 'sub_category_name', 'data' => 'sub_category_name', 'title' => 'Sub Category'],
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
        return 'Sub_category_' . date('YmdHis');
    }
}
