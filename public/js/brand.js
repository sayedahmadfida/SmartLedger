
/*
*===============================================================================*
*------------------------ Get data for Brand table ---------------------------- *
*===============================================================================*
*/
var brandTable = '';
$(function() {
    brandTable = $('#brand-dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/brand",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                searchable: false,
                orderable: false,
            },
            {
                data: 'brand_name',
                name: 'brand_name'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'brand_email',
                name: 'brand_email'
            },
            {
                data: 'address',
                name: 'address',
                searchable: false
            },
            {
                data: 'status',
                name: 'status',
                searchable: false
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


/*
*===============================================================================*
*-------------------------- Brand Form Validation ------------------------------*
*===============================================================================*
*/


$(document).ready(function(){
    $("#brand-form").validate({
        rules: {
            brand_name: {
                required: true,
                minlength: "3",
            },
            brand_phone: {
                required: true,
                minlength: "10",
            },
            brand_email: {
                required: true,
                email: true
            },
            country: {
                required: true,
            },
            brand_province :{
                required: true
            },
        },
        messages: {
            brand_name: {
                required: "Please Add Brand Name",
                minlength: "Please Insert at least 3 Characters",
            },
            brand_phone: {
                required: "Please Add Phone Number",
                minlength: "Please Insert at least 10 Characters",
            },
            brand_email: {
                required: "Please Add Email Address",
            },
            country: {
                required: "Please Select Country",
            },
            brand_province: {
                required: "Please Add Province",
            },
        },
    });
})






















/*
*===============================================================================*
*-------- Disable Brand ( After disabled brand can't accessable in search bar ) *
*-------- Active Brand ( After Activation can access in search bar )            *
*===============================================================================*
*/


function desableOrActiveBrand(event){
    let id = event.target.closest('a').getAttribute('data-id')
    let type = event.target.closest('a').getAttribute('data-type')
    let brand = event.target.closest('tr').children[1].textContent;
    
    worningSound();
    let confirmText ;
    let confirmBtnolor;
    let confirmBtnText;

    if(type == 'ACTIVE'){
        confirmText = `Want to active ${brand}?`;
        confirmBtnolor = '#00af0d';
        confirmBtnText = "Yes, active it!";
    }else{
        confirmText = `Want to disable ${brand}?`;
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
                url:   '/brand-action',
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
                        title: "Customer successfully Deleted!"
                      });
                      brandTable.ajax.reload();
              }});
        }
    }); 
}