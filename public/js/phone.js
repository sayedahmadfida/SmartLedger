
$("#phone-form").validate({
    rules: {
        phone: {
            required: true,
            minlength: "10",
        },
    },
    messages: {
        phone: {
            required: "Please Add Phone number",
            minlength: "Please Insert at least 10 Characters",
        },
    },
});

$("#edit-phone").validate({
    rules: {
        phone: {
            required: true,
            minlength: "10",
        },
    },
    messages: {
        phone: {
            required: "Please Add Phone number",
            minlength: "Please Insert at least 10 Characters",
        },
    },
});


function deletePhoneNumber(event) {
    let id = event.target.closest('a').getAttribute('data-id');
    let _token = $('[name="_token"]').val();

    Swal.fire({
        title: "Are you sure?",
        text: "Want to delete this phone number!?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: '/phone/' + id,
                data: {
                    _token: _token
                },
                type: 'DELETE',
                success: function (result) {
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
                        title: "Phone Number successfully Deleted!"
                    });


                    event.target.closest('th').remove();
                }
            });
        }
    });
}

