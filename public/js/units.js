var unitsTable;
$(document).ready(function() {
    
    /*
    *===============================================================================*
    *----------------------------- Form Validation ------- -------------------------*
    *===============================================================================*
    */ 

    $("#unit-form").validate({
        rules: {
            main_name: {
                required: true,
                minlength: "3",
                maxlength: 10,
            },
            short_name: {
                required: true,
                maxlength: 5,
            },
        },
        messages: {
            main_name: {
                required: "Please Add Unit Main Name",
                minlength: "Please Insert at least 3 Characters",
                maxlength: 'Please Insert maximum 10 Characters'
            },
            short_name: {
                required: "Please Select Customer Country ",
                maxlength: 'Please Insert maximum 5 Characters'
            },
        },
    });


    /*
    *===============================================================================*
    *------------------------ Get Data For Units DataTable -------------------------*
    *===============================================================================*
    */ 

     unitsTable = $("#units_table").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/units",
        columns: [{
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                searchable: false
            },
            { data: "main_name", name: "main_name" },
            { data: "short_name", name: "short_name" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

});


/*
*===============================================================================*
*----------------------------- DisbleOrActive ----------------------------------*
*===============================================================================*
*/ 



function disableOrAcriv(event){
    let id = event.target.closest('a').getAttribute('data-id')
    let type = event.target.closest('a').getAttribute('data-type')
    let unit = event.target.closest('tr').children[1].textContent;
    
    worningSound();
    let confirmText ;
    let confirmBtnolor;
    let confirmBtnText;

    if(type == 'ACTIVE'){
        confirmText = `Want to active ${unit}?`;
        confirmBtnolor = '#00af0d';
        confirmBtnText = "Yes, active it!";
    }else{
        confirmText = `Want to disable ${unit}?`;
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
                url:   '/units/'+id,
                type: 'DELETE', 
                data: {
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    type: type
                },
                success: function(result){
                    unitsTable.ajax.reload();
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
                        title: result
                      });
              }});
        }
    }); 
}


