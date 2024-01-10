$(document).ready(function() {

    $('#create_user_frm').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 4
            },
            last_name: {
                required: true,
                minlength: 4
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "/user/check-email",
                    type: "post",
                    data: {
                        username: function() {
                            return $("#email").val();
                        },
                        _token: function() {
                            return $("input[name=_token]").val();
                        }
                    }
                }
            },
            username: {
                required: true,
                minlength: 3,
                remote: {
                    url: "/user/check-username",
                    type: "post",
                    data: {
                        username: $("#username").val(),
                        _token: $("input[name=_token]").val()
                    }
                }
            },
            new_password: {
                required: true,
                minlength: 8,
            },
            retype_password: {
                required: true,
                minlength: 8,
                equalTo: '#new_password',
            }
        },
        messages: {
            first_name: {
                required: 'Please Enter First Name',
                minlength: 'Please More then 4 charecter'
            },
            last_name: {
                required: 'Please Enter Last Name',
                minlength: 'Please More then 4 charecter'
            },
            email: {
                required: 'Please Enter Email Address',
                email: 'Please Enter Valid Email',
                remote: 'Email already exist',
            },
            username: {
                required: 'Please Enter Username',
                minlength: 'Please Enter More Then 3 Characters',
                remote: 'Invalid username or User already exist',
            },
            new_password: {
                required: 'Please Enter Password',
                minlength: 'Your password must be at least 8 characters long'
            },
            retype_password: {
                required: 'Please Enter Retype Password',
                minlength: 'Your password must be at least 8 characters long',
                equalTo: 'Please enter the same password as New Password',
            }
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit();
            toastr.success('dataUpdated');
        }
    })





})


function accountDesable(event) {
    event.preventDefault()
    event.target.closest('tr').children[4].innerHTML = '<span class="label bg-red">Desabled</span>';
    var id = event.target.parentElement.getAttribute('data-id');
    var _token = $('input[name=_token]').val();

    $.ajax({
        method: "post",
        url: "user-action",
        data: {
            method: 'POST',
            id: id,
            type: 'active',
            _token: _token,
        },
        success: function(result) {
            
        },
    });

}

function accountActivation(event) {
    event.preventDefault()

    event.target.closest('tr').children[4].innerHTML = '<span class="label bg-green">Active</span>';
    var id = event.target.parentElement.getAttribute('data-id');
    var _token = $('input[name=_token]').val();


    $.ajax({
        method: "post",
        url: "user-action",
        data: {
            method: 'POST',
            id: id,
            type: 'desable',
            _token: _token,
        },
        success: function(result) {
            console.log(result);
        },
    });

}