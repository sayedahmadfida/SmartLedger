@extends('layouts.app')
@section('title', 'Customer')
@section('content')


    <div class="box box-solid  box-primary">
        <div class="box-header">
            <h3 class="box-title">Customers</h3>
                <div class="box-tools">
                    @can('customer.create')
                    <a class="text-primary"  data-toggle="modal" data-target="#create-customer" href="#">
                        <i class="fa fa-plus"></i> Add</a>
                    @endcan
                </div>
        </div>

        @include('pages.contacts.customer.partials.make-transaction')
        @include('pages.contacts.customer.partials.create-customer')


        @can('customer.view')
            <!-- /.box-header -->
            <div class="box-body table-responsive " style="min-height: 500px">
                <table id="customer_table" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No#</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Identity Card</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.box-body -->
        @endcan
    </div>
    <div class="modal fade show_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
    <!-- DataTables -->
@endsection

@section('script')
    <script src="{{ asset('js/customer.js') }}"></script>

    <script>
        
    var table = '';
    table = $('#customer_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('customer.index') }}",
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            searchable: false,
            orderable: false,
        },
        {
            data: 'customer_name',
            name: 'customer_name'
        },
        {
            data: 'address',
            name: 'address'
        },
        {
            data: 'identity_card',
            name: 'identity_card'
        },
        {
            data: 'created_at',
            name: 'created_at'
        },
        {
            data: 'status',
            name: 'status'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        }]
    })

    </script>

@endsection
