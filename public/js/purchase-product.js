
$(".product_select").chosen();


function setGrandTotal() {
    var quantity = $("#qunatity").val();
    var price = $("#price").val();

    var grand_total = quantity * price;
    $("#grand_total").val(grand_total);
    $('#unit_cost').val(price);
    $('#payment-amount').val(grand_total);
}