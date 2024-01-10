@extends('layouts.app')
@section('title', 'Edit User')
@section('css')
@endsection
@section('content')
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h4 class="box-title">Edit</h4>
            <div class="box-tools">
                <a class="btn btn-block btn-default" href="{{ url()->previous() }}">
                    <i class="fa  fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <form action="{{ route('users.update', $user->id) }}" id="create_user_frm" method="POST">
            <div class="box-body">
                <div class="___class_+?4___">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="">First Name:*</label>
                                <input type="text" value="{{ $user->f_name }}" placeholder="First Name"
                                    name="first_name" id="first_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="">Last Name:*</label>
                                <input type="text" value="{{ $user->l_name }}" placeholder="Last Name"
                                    id="last_name" name="last_name" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="box-footer">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-flat pull-right">Update</button>
                    
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/user_management.js') }}"></script>
@endsection
