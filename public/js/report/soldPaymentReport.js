$(document).ready(function () {

    var sold_payments = $('#sold_payments').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/reports/sold-payments",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                searchable: false,
            },
            {
                data: "paidAt",
                name: "paidAt",
            },
            {
                data: "paid_amount",
                name: "paid_amount",
            },
            {
                data: "customer_name",
                name: "customer_name",
            },
            {
                data: "address",
                name: "address",
            },
            {
                data: "paid_in",
                name: "paid_in",
            },
            {
                data: "billNumber",
                name: "billNumber",
            },
        ],
    });

    // Date picker
    $("#list_by_date").daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $("#list_by_date").html(
                start.format("MMMM D, YYYY") +
                " - " +
                end.format("MMMM D, YYYY")
            );
            sold_payments.ajax
            .url(
                "/reports/sold-payments?start_date=" +
                start.format("YYYY-MM-DD") +
                "&end_date=" +
                end.format("YYYY-MM-DD")
            )
            .load();
        }
    );

    $(document).on('change', '#list_by_customer', function (e) {
        listBy(sold_payments, 'customer', $(this).val());
    })
    $(document).on('change', '#list_by_country', function (e) {
        listBy(sold_payments, 'country', $(this).val());
    })
    $(document).on('change', '#list_by_province', function (e) {
        listBy(sold_payments, 'province', $(this).val());
    })
    $(document).on('change', '#list_by_state', function (e) {
        listBy(sold_payments, 'state', $(this).val());
    })

});


function listBy(table, listBy, value) {
    table.ajax
        .url(
            "/reports/sold-payments?listBy=" +
            listBy +
            "&value=" +
            value
        )
        .load();
}
