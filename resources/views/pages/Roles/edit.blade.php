@extends('layouts.app')
@section('title', 'Edit Role')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection
@section('content.header')
    
@endsection
@section('content')

<div class="box box-solid  box-primary">
    <div class="box-header">
        <h4 class="box-title">Edit Users Roles</h4>
    </div>
        <form action="{{ route('roles.update', $user->id) }}" method="POST" id="user_role_frm">
            @method('PUT')
            @csrf
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group  @error('username') has-error @enderror">
                            <label for="user_id">User:*</label>
                            @error('user_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="input-group">
                                @if ($user != null)
                                    <h4>{{ $user['f_name'] . ' ' . $user['l_name'] }}</h4>
                                    <input type="hidden" name="user_id" value="{{ $user['id'] }}">
                                @else
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select name="user_id" id="user_id" class="form-control user_role">
                                        <option selected disabled> Select User</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>Permissions:*</label>
                        @error('permession')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- User --}}
            <div class="box-header">
                <span class="box-title">User Manage:</span>
                <div class="row">
                    

                    <div class="col-md-2">
                        <div class="switch">
                            <label for="user_view">View</label>
                            <div class="onoffswitch">
                                <input type="checkbox" name="permession[]" value="user.view"
                                    {{ in_array('user.view', $permissions) ? 'checked' : '' }} class="onoffswitch-checkbox"
                                    id="user_view">
                                <label class="onoffswitch-label" for="user_view">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="switch">
                            <label for="user_create">Create</label>
                            <div class="onoffswitch">
                                <input type="checkbox" name="permession[]" value="user.create"
                                    {{ in_array('user.create', $permissions) ? 'checked' : '' }}
                                    class="onoffswitch-checkbox" id="user_create">
                                <label class="onoffswitch-label" for="user_create">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="switch">
                            <label for="user_edit">Edit</label>
                            <div class="onoffswitch">
                                <input type="checkbox" name="permession[]" value="user.update"
                                    {{ in_array('user.update', $permissions) ? 'checked' : '' }}
                                    class="onoffswitch-checkbox" id="user_edit">
                                <label class="onoffswitch-label" for="user_edit">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="switch">
                            <label for="user_delete">User Status</label>
                            <div class="onoffswitch">
                                <input type="checkbox" name="permession[]" value="user.delete"
                                    {{ in_array('user.delete', $permissions) ? 'checked' : '' }}
                                    class="onoffswitch-checkbox" id="user_delete">
                                <label class="onoffswitch-label" for="user_delete">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>

                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="switch">
                            <label for="user-role">Set Roles</label>
                            <div class="onoffswitch">
                                <input type="checkbox" name="permession[]" value="user.roles"
                                    {{ in_array('user.delete', $permissions) ? 'checked' : '' }}
                                    class="onoffswitch-checkbox" id="user-role">
                                <label class="onoffswitch-label" for="user-role">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>

                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            {{-- Customer --}}
            <div class="box-header">
                <span class="box-title">Customer:</span>
                <div class="row">
                    
                    <div class="col-md-2">
                        <div class="switch">
                            <label for="customer_view">View</label>
                            <div class="onoffswitch">
                                <input type="checkbox" name="permession[]"
                                    {{ in_array('customer.view', $permissions) ? 'checked' : '' }} value="customer.view"
                                    class="onoffswitch-checkbox" id="customer_view">
                                <label class="onoffswitch-label" for="customer_view">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="switch">
                            <label for="customer_create">Create</label>
                            <div class="onoffswitch">
                                <input type="checkbox" name="permession[]" value="customer.create"
                                    {{ in_array('customer.create', $permissions) ? 'checked' : '' }}
                                    class="onoffswitch-checkbox" id="customer_create">
                                <label class="onoffswitch-label" for="customer_create">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="switch">
                            <label for="customer_edit">Edit</label>
                            <div class="onoffswitch">
                                <input type="checkbox" name="permession[]" value="customer.update"
                                    {{ in_array('customer.update', $permissions) ? 'checked' : '' }}
                                    class="onoffswitch-checkbox" id="customer_edit">
                                <label class="onoffswitch-label" for="customer_edit">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="switch">
                            <label for="customer_delete">Delete</label>
                            <div class="onoffswitch">
                                <input type="checkbox" name="permession[]" value="customer.delete"
                                    {{ in_array('customer.delete', $permissions) ? 'checked' : '' }}
                                    class="onoffswitch-checkbox" id="customer_delete">
                                <label class="onoffswitch-label" for="customer_delete">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>

                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            

            <div class="box-footer">
                <div class="col-sm-12">
                    <button type="submit" id="save_user_role" class="btn btn-primary btn-flat pull-right">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    {{-- <script src="{{ asset('js/role.js') }}"></script> --}}
@endsection
