$(document).ready(function () {

    var purchased_payments = $('#purchased_payments').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/reports/purchased-payments",
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
                data: "ltd_name",
                name: "ltd_name",
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
                data: "purchaseInvoiceNo",
                name: "purchaseInvoiceNo",
            },
        ],
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(), data;
            // converting to interger to find total
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            // computing column Total of the complete result 
            var paid_amount = api
                .column(2)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            $(api.column(2).footer()).html(paid_amount);
        },
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
            purchased_payments.ajax
                .url(
                    "/reports/purchased-payments?start_date=" +
                    start.format("YYYY-MM-DD") +
                    "&end_date=" +
                    end.format("YYYY-MM-DD")
                )
                .load();
        }
    );

    $(document).on('change', '#list_by_supplier', function (e) {
        listBy(purchased_payments, 'supplier', $(this).val());
    })
    $(document).on('change', '#list_by_country', function (e) {
        listBy(purchased_payments, 'country', $(this).val());
    })
    $(document).on('change', '#list_by_province', function (e) {
        listBy(purchased_payments, 'province', $(this).val());
    })
    $(document).on('change', '#list_by_state', function (e) {
        listBy(purchased_payments, 'state', $(this).val());
    })

});


function listBy(table, listBy, value) {
    table.ajax
        .url(
            "/reports/purchased-payments?listBy=" +
            listBy +
            "&value=" +
            value
        )
        .load();
}
