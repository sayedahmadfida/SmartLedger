$(document).ready(function () {
    /*
    *===============================================================================*
    *------------------------ Customer Form Validation ---------------------------- *
    *===============================================================================*
    */
    $("#customer_frm").validate({
        rules: {
            name: {
                required: true,
                minlength: "3",
            },
            country: {
                required: true,
            },
            province: {
                required: true,
                minlength: "5",
            },
            state: {
                required: true,
            },
            identity_card: {
                required: true,
                minlength: "5",
            },
            phone: {
                required: true,
                minlength: "10",
            },
        },
        messages: {
            name: {
                required: "Please Add Customer Name",
                minlength: "Please Insert at least 3 Characters",
            },
            country: {
                required: "Please Select Customer Country ",
            },
            province: {
                required: "Please Add Country Province",
                minlength: "Please Insert at least 5 Characters",
            },
            state: {
                required: "Please Add Customer ShopNo#",
            },
            identity_card: {
                required: "Please Add Customer Identity Card",
                minlength: "Please Insert at least 5 Characters",
            },
            phone: {
                required: "Please Add Customer Phone No",
                minlength: "Please Insert at least 10 Characters",
            },
        },
    });

    /*
    *===============================================================================*
    *-------------------- Customer Update Form Validation ------------------------- *
    *===============================================================================*
    */

    $("#customerUpdate").validate({
        rules: {
            customer_name: {
                required: true,
                minlength: "3",
            },
            customer_province: {
                required: true,
                minlength: "5",
            },
            customer_village: {
                required: true,
            },
            identity_card: {
                required: true,
                minlength: "5",
            },
        },
        messages: {
            customer_name: {
                required: "Please Add Customer Name",
                minlength: "Please Insert at least 3 Characters",
            },
            customer_country: {
                required: "Please Select Customer Country ",
            },
            customer_province: {
                required: "Please Add Shop #",
                minlength: "Please Insert at least 5 Characters",
            },
            customer_village: {
                required: "Please Add Customer ShopNo#",
            },
            identity_card: {
                required: "Please Add Customer Identity Card",
                minlength: "Please Insert at least 5 Characters",
            },
        },
    });


});


/*
*===============================================================================*
*------------------------------- Delete Customer ------------------------------ *
*===============================================================================*
*/
function deleteCustomer(event) {
    let id = event.target.closest('a').getAttribute('data-id');
    let customer = event.target.closest('tr').children[1].textContent;
    let _token = $('[name="_token"]').val();

    let type = event.target.closest('a').getAttribute('data-type')

    worningSound();
    let confirmText ;
    let confirmBtnolor;
    let confirmBtnText;

    if(type == 'ACTIVE'){
        confirmText = `Want to active ${customer}?`;
        confirmBtnolor = '#00af0d';
        confirmBtnText = "Yes, active it!";
    }else{
        confirmText = `Want to disable ${customer}?`;
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
                url: '/customer/' + id,
                data: {
                    _token: _token
                },
                type: 'DELETE',
                success: function (result) {
                    console.log(result);
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
                    table.ajax.reload();
                }
            });
        }
    });
}



/*
*===============================================================================*
*-------------------------- Customer Transaction ------------------------------ *
*===============================================================================*
*/
function deleteTransaction(event) {
    let formId = event.target.closest('a').getAttribute('data-form-id');
    let deletValue = $(`[data-amount=${formId}]`).val();


    Swal.fire({
        title: "Are you sure?",
        text: `Want to delete ${deletValue} amount?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4CAF50",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, clear it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $('#' + formId).submit();
        }
    });
}




/*
*===============================================================================*
*-------------------------- Customer Ledger Clear ----------------------------- *
*===============================================================================*
*/
function clearAccount() {

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

            $('#cleare-account-form').submit();
        }
    });

}



$("#purchase_invoice_date").datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    immediateUpdates: true,
    todayBtn: true,
    todayHighlight: true,
});

/*
*===============================================================================*
*--------------------- Customer Make Credit Validation ------------------------ *
*===============================================================================*
*/
$("#make_credit").validate({
    rules: {
        paid_amount: {
            required: true
        },
        money_resources_id: {
            required: true
        },
        paid_description: {
            required: true
        },
    },
    messages: {
        paid_amount: {
            required: "Please Enter Paid Amount!",
        },
        money_resources_id: {
            required: "Please Select Money Resource!",
        },
        paid_description: {
            required: "Please Enter Discription!",
        },
    },
    submitHandler: function (form) {
        var data = $(form).serialize();
        console.log($(form).attr("action"));
        $.ajax({
            method: "POST",
            url: $(form).attr("action"),
            dataType: "json",
            data: data,
            success: function (result) {
                if (!result.error) {
                    window.location.reload();
                } else {
                    toastr.error(error.msg);
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    },
});





/*
*===============================================================================*
*-------------------------- Customer Transaction ------------------------------ *
*===============================================================================*
*/

function setModelId(event){
    $('#model-id').val(event.target.closest('a').getAttribute('data-id'));
}





/*
*===============================================================================*
*-------------------------- Transaction Validation ---------------------------- *
*===============================================================================*
*/

$(document).ready(function(){
    

    $("#make-transaction").validate({
        rules: {
            amount: {
                required: true,
                number: true
            },
        },
        messages: {
            amount : {    
                required: "Please Add Amount",
                number: "Write Just Number",
            },
        },
    });
})

