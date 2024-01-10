
/*
*===============================================================================*
*------------------------------- Delete user ------------------------------ *
*===============================================================================*
*/ 
function activeOrDisableUser(event){

    let id = event.target.closest('a').getAttribute('data-id');
    let user = event.target.closest('tr').children[1].textContent;
    let tr = event.target.closest('tr').children[5];
    

    let _token = $('[name="_token"]').val();
    let type = event.target.closest('a').getAttribute('data-type')

    // worningSound();
    let confirmText ;
    let confirmBtnolor;
    let confirmBtnText;

    if(type == 'ACTIVE'){
        confirmText = `Want to active ${user}?`;
        confirmBtnolor = '#00af0d';
        confirmBtnText = "Yes, active it!";
    }else{
        confirmText = `Want to disable ${user} account?`;
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
                url: '/user-action',
                data: {
                    id: id,
                    type:type,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST', 
                success: function(result){
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
                      if(result.status){

                        if(result.type == 1){
                            tr.innerHTML = '<span class="label bg-green">Active</span>';
                        }else{
                            tr.innerHTML = '<span class="label bg-red">Desabled</span>';
                        }
                          Toast.fire({
                              icon: "success",
                              title: result.msg
                            });
                    }else{
                        Toast.fire({
                            background: '#d33',
                            color:'white',
                            icon: "warning",
                            title: 'Opp! something wrong.'
                        });
                    }
              }});
        }
    });
    
}
