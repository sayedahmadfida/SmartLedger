@extends('layouts.app')
@section('title', 'Customer')
@section('content')
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Customers</h3>
            @can('customer.create')

                <div class="box-tools">
                    <a class="text-primary" href="{{ route('customer.create') }}">
                        <i class="fa fa-plus"></i> Add New Customer</a>
                </div>
            @endcan
        </div>

        @csrf
        @can('customer.view')
            <div class="box-body table-responsive " style="min-height: 500px">
                <table id="customer_table" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No#</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Identity Card</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        @endcan
    </div>
    <!-- DataTables -->
@endsection

@section('script')
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/customer.js') }}"></script>
 
    <script type="text/javascript">
    var trushTable = null;
        $(function() {
             trushTable = $('#customer_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customerRecycleBin') }}",
                columns: [
                    {
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        searchable: false,
                        orderable:false
                    },
                    {
                        data: 'deleted_at',
                        name: 'deleted_at',
                        width: '10%'
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            })
        });

        
    </script>
@endsection
