var userActivityTable = null;
$(function() {
     userActivityTable = $('#user-activity').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('user-activities') }}",
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
                searchable: false
            },
            {
                data: 'activity_description',
                name: 'activity_description',
                
            },{
                data: 'deleted_at',
                name: 'deleted_at',
                width: '10%',
                searchable: false
            },
        ]
    })
});