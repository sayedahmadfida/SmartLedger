@extends('layouts.app')
@section('title', 'Money Resources')
@section('content.header')
@endsection
@section('content')
<div class="box box-solid  box-primary">
    <div class="box-header">
        <h3 class="box-title">User Activities</h3>
            
        <div class="box-tools">

                <a  href="{{url()->previous()}}">
                    <i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body ">
        <div class="table-responsive " style="min-height: 500px">
            <table id="user-activity" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>No#</th>
                        <th>User</th>
                        <th>Activity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
                <tfoot>
                    <tr>
                        <th>No#</th>
                        <th>User</th>
                        <th>Activity</th>
                        <th>Date</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- DataTables -->


    @endsection
    @section('script')
    <!-- <script src="{{ asset('js/user-activity.js') }}"></script> -->
    
    
    <script>
        var userActivityTable = null;
        $(function() {
            userActivityTable = $('#user-activity').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user-activities.index') }}",
                columns: [
                    {
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        searchable: false,
                        orderable:false
                    },
                    
                    {
                        data: 'full_name',
                        name: 'full_name',
                        width: '20%'
                    },
                    {
                        data: 'activity_description',
                        name: 'activity_description',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        width: '9%'
                    },
                ]
            })
        });
    </script>
    
    @endsection