$(document).ready(function(){
    /*
*===============================================================================*
*------------------- Get Data For Product DataTable ----------------------------*
*===============================================================================*
*/

productTable = $("#product-details-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/purchase-product",
    columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            searchable: false
        },
        { 
            data: "product_name", 
            name: "product_name" 
        },
        { 
            data: "quantity", 
            name: "quantity" 
        },
        { 
            data: "price", 
            name: "price"
        },
        { 
            data: "grand_total", 
            name: "grand_total" 
        },
        { 
            data: "discount", 
            name: "discount" 
        },
        { 
            data: "warehouse", 
            name: "warehouse"
        },
        { 
            data: "created_at", 
            name: "created_at"
        },
        {
            data: "action",
            name: "action",
            orderable: false,
            searchable: false,
        },
    ],
});


})




/*
*===============================================================================*
*---------------------------- Custome Field Toggle -----------------------------*
*===============================================================================*
*/
let i = false;
function showCustomField(){
    i == true ? $('#custom-fields').addClass('hidden') : $('#custom-fields').removeClass('hidden')
    
    i = !i;
}
/*
*===============================================================================*
*------------------------------------- Chosen ----------------------------------*
*===============================================================================*
*/

$('#product_id').chosen();





/*
*===============================================================================*
*--------------------------- Send Form Data With AJAX --------------------------*
*===============================================================================*
*/

function saveProductDetail(event){
    event.preventDefault()
    let url = $('#save-product-details-form').attr('action')
    let _token = $('meta[name="csrf-token"]').attr('content')
    let data = $('#save-product-details-form').serialize() + '&_token='+_token;


    $.ajax({
        url:   url,
        type: 'post', 
        data: data,
        success: function(result){
          console.log(result);
      }});


}

// $( "form" ).on( "submit", function( event ) {
//     event.preventDefault();
//     console.log( $( this ).serialize() );
//   });