 $(document).ready(function() {
     $('#user_role_frm').validate({
         rules: {
             //  permession: 'required',
             user_id: 'required',
         },
         messages: {
             //  permession: 'Select One Permission!',
             user_id: 'Select User'
         }
     })
 });