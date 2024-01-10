$(document).ready(function() {
    
    var purchasedProducts = $('#purchasedProducts').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/reports/purchased-products",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                searchable: false,
            },
            {
                data: "purchased_date",
                name: "purchased_date",
            },
            {
                data: "product_name",
                name: "product_name",
            },
            {
                data: "ltd_name",
                name: "ltd_name",
            },
            {
                data: "invoice_number",
                name: "invoice_number",
            },
            {
                data: "quantity",
                name: "quantity",
            },
            {
                data: "purchased_price",
                name: "purchased_price",
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
            function(start, end) {
                $("#list_by_date").html(
                    start.format("MMMM D, YYYY") +
                    " - " +
                    end.format("MMMM D, YYYY")
                );
                purchasedProducts.ajax
                    .url(
                        "/reports/purchased-products?start_date=" +
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
                    listBy(purchasedProducts, 'product', ui.item.id)
                },
            });
        },
    });


    $(document).on('change', '#list_by_supplier', function (e) {
        listBy(purchasedProducts, 'supplier',$(this).val());
    })


});

function listBy(table, listBy, value) {
    table.ajax
        .url(
            "/reports/purchased-products?listBy=" +
            listBy +
            "&value=" +
            value
        )
        .load();
}
