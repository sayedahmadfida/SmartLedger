var productTable;
$(document).ready(function () {

/*
*===============================================================================*
*---------------------------- Form Validation ----------------------------------*
*===============================================================================*
*/

 $("#save_product_frm").validate({
        rules: {
            product_name: {
                required: true,
                minlength: 3,
                maxlength: 50,
            },
            sub_category_id: {
                required: true,
            },
            unite_id: {
                required: true,
            },
        },
        message: {
            product_name: {
                required: "Please Enter Product Name!",
                minlength: "Enter at least 3 Characters",
                maxlength: "Enter Less then 50 Characters",
            },
            sub_category_id: {
                required: "Please Select Sub Category",
            },
            unite_id: {
                required: "Please Select Unit",
            },
        },
    });




/*
*===============================================================================*
*------------------- Get Data For Product DataTable ----------------------------*
*===============================================================================*
*/

    productTable = $("#product-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/product",
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
                data: "sub_category_name", 
                name: "sub_category_name" 
            },
            { 
                data: "unit", 
                name: "unit",
                searchable: false
            },
            { 
                data: "alert_quantity", 
                name: "alert_quantity" 
            },
            { 
                data: "created_at", 
                name: "created_at" 
            },
            { 
                data: "status", 
                name: "status",
                searchable: false
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

function removePropertyField(event, property_id) {

    if (property_id != 0) {
        Swal.fire({
            title: "Are you sure?",
            text: 'To Remove This Property!',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: "#3085d6",
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                removerProductFieldFromDB(property_id);
                $(event.target).parent().closest('.custom_fields').remove()
            }
        }); 

    } else {
        $(event.target).parent().closest('.custom_fields').remove()
    }
}


function removerProductFieldFromDB(property_id) {
    $.ajax({
        url: "/product/property/" + property_id,
        success: function (result) {
            console.log(result);
            if (result.success) {
                toastr.success('Product Attribute has successfuly Removed');
            }
        },
    });
}





function disableOrActive(event){
    
    let id = event.target.closest('a').getAttribute('data-id')
    let type = event.target.closest('a').getAttribute('data-type');
    let product = event.target.closest('tr').children[1].textContent;
    
    worningSound();
    let confirmText ;
    let confirmBtnolor;
    let confirmBtnText;

    if(type == 'ACTIVE'){
        confirmText = `Want to active ${product}?`;
        confirmBtnolor = '#00af0d';
        confirmBtnText = "Yes, active it!";
    }else{
        confirmText = `Want to disable ${product}?`;
        confirmBtnolor = "#d33";
        confirmBtnText = "Yes, disable it!";
    }


    Swal.fire({
        title: "Are you sure?",
        text: confirmText,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: confirmBtnolor,
        cancelButtonColor: "#3085d6",
        confirmButtonText: confirmBtnText
    }).then((result) => {
        if (result.isConfirmed) {
            
            $.ajax({
                url:   '/product-action',
                type: 'post', 
                data: {
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    type: type
                },
                success: function(result){
                    alertSound()
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.onmouseenter = Swal.stopTimer;
                          toast.onmouseleave = Swal.resumeTimer;
                        }
                      });
                      Toast.fire({
                        icon: "success",
                        title: "Product successfully Removed!"
                      });
                      productTable.ajax.reload();
              }});
        }
    }); 

}