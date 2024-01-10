@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('bower_components/chosen/bootstrap-chosen.css') }}">
@endsection
@section('title', 'Edit Customer') @section('content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">Edit Customer</h3>
        <div class="box-tools">
            <a class="text-white" href="{{ url()->previous() }}">
                <i class="fa  fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="box-body">
     
        <form action="{{ route('customer.update', Crypt::encrypt($customer->id)) }}" method="POST" id="customer_frm">
            @csrf @method('PATCH')
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Customer Name:*</label>
                        <input type="text" name="name" value="{{$customer->customer_name}}"
                            class="form-control" placeholder="Customer Name"> 
                    </div>
                </div>

                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Identity Card No:</label>
                        <input type="text" name="identity_card" value="{{$customer->identity_card}}"
                            class="form-control" placeholder="Identity Card No">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Country:*</label>
                        {{-- <input type="text" name="country" class="form-control" placeholder="Country"> --}}
                        <select name="country" class="form-control country">
                            @foreach ($countries as $list)
                            <option value="{{ $list->name }}"
                                {{$list->name == $customer->customer_country ? 'selected' : null }}>{{ $list->name }}
                            </option>
                            @endforeach
                        </select> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Province</label>
                        <input type="text" name="province" value="{{$customer->customer_province}}"
                            class="form-control" placeholder="Province"> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>State:</label>
                        <input type="text" name="state" value="{{$customer->customer_state}}"
                            class="form-control" placeholder="State">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="pull-right">
                        <button type="submit" value="submit" class="btn btn-primary submit_product_form">Update</button>
                    </div>
                </div>
        </form>


    </div>
</div>

@endsection


@section('script')
<script src="{{ asset('js/customer.js') }}"></script>
@endsection