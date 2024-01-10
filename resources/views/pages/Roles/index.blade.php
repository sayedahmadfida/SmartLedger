@extends('layouts.app')
@section('title', 'Roles')
@section('content')
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h4 class="box-title">Roles List</h4>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>No#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$user->f_name.' '. $user->l_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->type}}</td>
                            <td>
                                @can('role.update')
                                <a href="{{ route('roles.edit', $user->id) }}" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
