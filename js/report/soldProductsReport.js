$(document).ready(function () {

    var soldProducts = $('#soldProducts').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/reports/sold-products",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                searchable: false,
            },
            {
                data: "sold_date",
                name: "sold_date",
            },
            {
                data: "product_name",
                name: "product_name",
            },
            {
                data: "customer_name",
                name: "customer_name",
            },
            {
                data: "bill_number",
                name: "bill_number",
            },
            {
                data: "quantity",
                name: "quantity",
            },
            {
                data: "sold_price",
                name: "sold_price",
            },
            {
                data: "grand_total",
                name: "grand_total",
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
            soldProducts.ajax
                    .url(
                        "/reports/sold-products?start_date=" +
                        start.format("YYYY-MM-DD") +
                        "&end_date=" +
                        end.format("YYYY-MM-DD")
                    )
                    .load();
        }
    );


    $.ajax({
        url: "/get_products_list",
        dataType: "json",
        success: function(result) {
            $("#list_by_product").autocomplete({
                source: result,
                minLength: 2,
                response: function(event, ui) {},
                select: function(event, ui) {
                    // console.log(ui.item.id);
                    $("#list_by_product").val(ui.item.value);
                    listBy(soldProducts, 'product', ui.item.id)
                },
            });
        },
    });


    $(document).on('change', '#list_by_customer', function (e) {
        listBy(soldProducts, 'customer',$(this).val());
    })

});

function listBy(table, listBy, value) {
    table.ajax
        .url(
            "/reports/sold-products?listBy=" +
            listBy +
            "&value=" +
            value
        )
        .load();
}
