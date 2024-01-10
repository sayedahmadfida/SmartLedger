@extends('layouts.app')
@section('title', 'Users')
@section('content.header')
@endsection
@section('content')
<div class="box box-solid  box-primary">
    <div class="box-header">
        <h4 class="box-title">Users List</h4>
        <div class="box-tools">
            @can('user.create')
            <div class="box-tools">
                <a class=" btn text-primary" href="{{ route('users.create') }}">
                    <i class="fa fa-plus"></i> Add</a>
            </div>
            @endcan
        </div>
    </div>
    <div class="box-body">
        @can('user.view')
        <div class="table-responsive" style="min-height: 500px">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $recored)

                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$recored->f_name.' ( '.$recored->l_name. ' ) '}}</td>
                        <td>{{$recored->email}}</td>
                        <td>{{$recored->username}}</td>
                        <td>{{substr($recored->created_at, 0, 10)}}</td>
                        <td id="user-status">
                            @if($recored->status == 1)
                            <span class="label bg-green">Active</span>
                            @else
                            <span class="label bg-red">Desabled</span>
                            @endif
                        </td>
                        <td>

                            @if(auth()->user()->can('user.update') || auth()->user()->can('user.delete') || auth()->user()->can('user.roles') )
                            <div class="btn-group">
                                <a href="javascript:void(0)" class="btn-primary btn btn-xs dropdown-toggle"
                                    aria-expanded="false" data-toggle="dropdown">
                                    <span>Action <i class="fa-solid fa-caret-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">

                                    @can('user.update')
                                    <li>
                                        <a href="{{route('users.edit', $recored->id)}}"><i
                                                class="fa fa-pencil-square text-success" aria-hidden="true"></i>Edit</a>
                                    </li>
                                    @endcan
                                    @can('user.delete')
                                    @if($recored->status == 1)
                                    <li>
                                        <a href="#" onclick="activeOrDisableUser(event)" data-type="DISABLE"
                                            data-id="{{Crypt::encrypt($recored->id)}}"><i
                                                class="fa-solid fa-ban text-danger"></i>Disable</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="#" onclick="activeOrDisableUser(event)" data-type="ACTIVE"
                                            data-id="{{Crypt::encrypt($recored->id)}}">
                                            <i class="fa-regular fa-circle-check"></i> Active</a>
                                    </li>
                                    @endif
                                    @endcan
                                    @can('user.roles')
                                    <li>
                                        <a href="{{ route('roles.edit', $recored->id) }}" title="Set Roles"><i
                                                class="fa fa-briefcase text-primary"></i>Roles</a>

                                    </li>
                                    @endcan


                                </ul>
                            </div>
                            @else
                            <span class="label bg-red">Access Denid</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endcan
        @csrf

    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/users.js') }}"></script>
@endsection