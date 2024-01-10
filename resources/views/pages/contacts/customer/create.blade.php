@extends('layouts.app')
@section('title', 'Customer Registeration')
@section('css')

@endsection
@section('content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">Register New Customer</h3>
        <div class="box-tools">
            <a class="text-white" href="{{ url()->previous() }}">
                <i class="fa  fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="box-body">

        <!-- Create LTD Form !-->
        <form action="{{ route('customer.store') }}" method="post" id="customer_frm">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Customer Name:*</label>
                        <input type="text" name="customer_name" class="form-control" placeholder="Customer Name">
                        @error('customer_name')
                        <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Identity Card No:</label>
                        <input type="text" name="identity_card" class="form-control" placeholder="Identity Card No">
                        @error('identity_card')
                        <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Phone Number:*</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone Number">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Country:*</label>
                        <select name="customer_country" class="form-control customer_country">
                            @foreach ($countries as $list)
                            <option value="{{ $list->name }}">{{ $list->name }}</option>
                            @endforeach
                        </select>
                        @error('customer_country')
                        <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Province</label>
                        <input type="text" name="customer_province" class="form-control" placeholder="Province">
                        @error('customer_province')
                        <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Shop No#:</label>
                        <input type="text" name="customer_village" class="form-control" placeholder="Shop No">
                        @error('customer_village')
                        <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-right">
                        <button type="submit" value="submit" class="btn btn-primary submit_product_form">Save</button>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/customer.js') }}"></script>
@endsection