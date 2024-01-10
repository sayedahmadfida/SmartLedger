var whrehouseTable;

$(document).ready(function(){

    /*
    *===============================================================================*
    *------------------------ Get data for Brand table ---------------------------- *
    *===============================================================================*
    */
   $(function() {
       whrehouseTable = $('#warehouse-table').DataTable({
           processing: true,
           serverSide: true,
           ajax: "/warehouse",
           columns: [
               {
                   data: "DT_RowIndex",
                   name: "DT_RowIndex",
                   searchable: false,
                   orderable: false,
                },
            {
                data: 'warehouse_name',
                name: 'warehouse_name'
            },
            {
                data: 'warehouse_address',
                name: 'warehouse_address'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'created_at',
                name: 'created_at'
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

})
