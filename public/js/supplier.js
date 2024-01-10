var supplier_table = null;
$(document).ready(function(){
    

    
/*
*===============================================================================*
*----------------------- Get Data For Supplier DataTable ---------------------- *
*===============================================================================*
*/ 


     supplier_table = $("#supplier_dataTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/supplier/",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                searchable: false,
                orderable: false,
            },
            { 
                data: "business_name", 
                name: "business_name" 
            },
            { 
                data: "address", 
                name: "address", 
                searchable: false 
            },
            { 
                data: "business_type", 
                name: "business_type"
            },
            { 
                data: "created_at", 
                name: "created_at" 
            },
            { 
                data: "status", 
                name: "status",
                orderable: false 
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });




/*
*===============================================================================*
*--------------------------- Supplier From Validation ------------------------- *
*===============================================================================*
*/ 

    $("#supplier-create-form").validate({
        rules: {
            name: {
                required: true,
                minlength: "3",
            },
            province: {
                required: true,
                minlength: "3",
            },
            state: {
                required: true,
            },
            phone:{
                required: true
            } 
        },
        messages: {
            name: {
                required: "Please Add Supplier Name",
                minlength: "Please Insert at least 3 Characters",
            },
            province: {
                required: "Please Add Province Name #",
                minlength: "Please Insert at least 3 Characters",
            },
            state: {
                required: "Please Add State",
            }
        },
    });





    
/*
*===============================================================================*
*--------------------------- Transaction From Validation ---------------------- *
*===============================================================================*
*/ 

$("#make-transaction").validate({
    rules: {
        amount: {
            required: true,
            number: true
        },
    },
    messages: {
        amount: {
            required: "Please Add Amount",
            number: "Write Just Number",
        }
    },
});


});







/*
*===============================================================================*
*------------------------------- Delete Supplier ------------------------------ *
*===============================================================================*
*/ 
function activeOrDisableSupplier(event){
    let id = event.target.closest('a').getAttribute('data-id');
    let supplier = event.target.closest('tr').children[1].textContent;
    

    let _token = $('[name="_token"]').val();
    let type = event.target.closest('a').getAttribute('data-type')

    worningSound();
    let confirmText ;
    let confirmBtnolor;
    let confirmBtnText;

    if(type == 'ACTIVE'){
        confirmText = `Want to active ${supplier}?`;
        confirmBtnolor = '#00af0d';
        confirmBtnText = "Yes, active it!";
    }else{
        confirmText = `Want to disable ${supplier}?`;
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
                url: '/supplier/'+id,
                data: {
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                method: 'DELETE', 
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
                        title: "Supplier successfully Deleted!"
                      });
                      supplier_table.ajax.reload();
              }});
        }
    });
    
}




/*
*===============================================================================*
*------------------------------- Delete Transaction --------------------------- *
*===============================================================================*
*/ 
function deleteTransaction(event){
    worningSound();
    let id = event.target.closest('a').getAttribute('data-id')
    $('#delete_form').attr('action',   '/transaction/'+id);
    
    let _token =  $('meta[name="csrf-token"]').attr('content')
    Swal.fire({
        title: "Are you sure?",
        text: `Want to delete it?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $('#delete_form').submit();

        }
    }); 
}



/*
*===============================================================================*
*-------------------------- Customer Transaction ------------------------------ *
*===============================================================================*
*/

function setModelId(event){
    $('#model-id').val(event.target.closest('a').getAttribute('data-id'));
    console.log(event.target.closest('a').getAttribute('data-id'))
}





/*
*===============================================================================*
*-------------------------- Supplier Ledger Clear ----------------------------- *
*===============================================================================*
*/
function clearLedger() {

    Swal.fire({
        title: "Are you sure?",
        text: `Want to clear ${$('#customer-name').text()} account`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4CAF50",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, clear it!"
    }).then((result) => {
        if (result.isConfirmed) {

            $('#cleare-ledger-form').submit();
        }
    });

}

