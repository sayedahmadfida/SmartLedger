<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        // return datatables()
        //     ->eloquent($query)
        //     ->addColumn('full_name', function ($row) {
        //         return $row->f_name . ' ' . $row->l_name;
        //     })
        //     ->editColumn('created_at', function ($row) {
        //         return substr($row->created_at, 0, 10);
        //     })
        //     ->addColumn('action', function ($row) {
        //         $action = '';
        //         if (auth()->user()->can('user.update')) {
        //             $route = route('users.edit',$row->id);
        //             $action .=
        //             '<a href="'.$route.'" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
        //             ';
        //         }
        //         if ($row->type != 'ADMIN') {
        //             if (auth()->user()->can('user.delete')) {
        //                 $route = route('users.destroy',Crypt::encrypt($row->id));
        //                 $action .= '
        //             <button data-action="'.$route.'" data-toggle="modal" data-target="#modal-delete" class="btn btn-danger btn-xs delete_user">
        //                 <i class="fa fa-trash"></i>
        //             </button>
        //             ';
        //             }
        //         }

        //         return $action;
        //     });

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
    //     $users = User::where('admin_id', session('user.admin_id'))
    //         ->where('type', '!=' ,'ADMIN')
    //         ->select(['id', 'type', 'f_name', 'l_name', 'email', 'created_at']);
    //     return $users;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
           
            ->minifiedAjax()
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // 'id',
            'full_name',
            'email',
            'type',
            'created_at',
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
        return 'Users_' . date('YmdHis');
    }
}
