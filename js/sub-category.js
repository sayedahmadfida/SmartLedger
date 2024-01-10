
/*
*===============================================================================*
*--------------------- Get data for Sub Category table ------------------------ *
*===============================================================================*
*/
var subCategoryTable = '';
$(function() {
    subCategoryTable = $('#category-dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/sub-category",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                searchable: false,
                orderable: false,
            },
            {
                data: 'category_name',
                name: 'category_name'
            },
            {
                data: 'sub_category_name',
                name: 'sub_category_name'
            },
            {
                data: 'created_at',
                name: 'created_at',
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
    $("#sub-category-form").validate({
        rules: {
            sub_category: {
                required: true,
                minlength: "3",
            }
        },
        messages: {
            sub_category: {
                required: "Please Add Sub-Category Name!",
                minlength: "Please Insert at least 3 Characters",
            }    
        }
    });
})
