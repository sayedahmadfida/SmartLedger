@extends('layouts.app')
@section('title', 'Add User')
@section('css')
@endsection
@section('content.header')
@endsection
@section('content')
    <div class="box box-solid box-primary">

        <div class="box-header">
            <h4 class="box-title">Add User</h4>
            <div class="box-tools">
                <a class="btn " href="{{ url()->previous() }}">
                    <i class="fa  fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <form action="{{ route('users.store') }}" id="create_user_frm" method="POST">
            {{-- @method('POST') --}}
            @csrf
            <div class="box-body">
                <div class="___class_+?4___">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group @error('first_name') has-error @enderror">
                                <label for="">First Name:*</label>
                                @error('first_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                <input type="text" name="first_name" placeholder="First Name" id="first_name"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group  @error('last_name') has-error @enderror">
                                <label for="">Last Name:*</label>
                                @error('last_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                <input type="text" name="last_name" placeholder="Last Name" id="last_name"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group  @error('email') has-error @enderror">
                                <label for="">Email:*</label>
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa-solid fa-at"></i></span>
                                    <input type="email" name="email" placeholder="Email" id="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group  @error('username') has-error @enderror">
                                <label for="">Username:*</label>
                                @error('username')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" name="username" id="username" placeholder="Username"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group  @error('new_password') has-error @enderror">
                                <label for="">Password:*</label>
                                @error('new_password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                    <input type="password" placeholder="Password" name="new_password" id="new_password"
                                        class="form-control new_password">

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group  @error('retype_password') has-error @enderror">
                                <label for="">Confirm Password:*</label>
                                @error('retype_password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                    <input type="password" name="retype_password" id="retype_password"
                                        placeholder="Password" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="box-footer">
                <div class="col-sm-12">
                    <button type="submit" id="save_user" class="btn btn-primary btn-flat pull-right">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/user_management.js') }}"></script>
@endsection
