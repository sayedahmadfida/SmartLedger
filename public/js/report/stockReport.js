$(document).ready(function () {


    var stock_table = $('#stock_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/reports/stock-report",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                searchable: false,
            },
            {
                data: "product_name",
                name: "product_name",
            },
            {
                data: "unit_cost",
                name: "unit_cost",
            },
            {
                data: "warehouse_name",
                name: "warehouse_name",
            },
            {
                data: "stock",
                name: "stock",
            },
            {
                data: "sold",
                name: "sold",
            },
            {
                data: "bougth",
                name: "bougth",
            },
        ],
    });

    $(document).on('change', '#list_by_Warehouse', function (e) {
        listByWarehouse(stock_table, $(this).val());
    })

})

function listByWarehouse(table, value) {
    table.ajax
        .url(
            "/reports/stock-report?value=" +
            value
        )
        .load();
}
