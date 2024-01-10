$(document).ready(function() {

    $(document).on('click', '.create-category-modal', function(e) {
        // console.log('object');
        e.preventDefault();
        var container = $(this).data("container");

        $.ajax({
            url: $(this).data("href"),
            dataType: "html",
            success: function(result) {
                $(container).html(result).modal('show');
            }
        });
    });

    $(document).on('click', '.edit_category_modal', function(e) {
        // console.log('object');
        e.preventDefault();
        var container = $(this).data("container");

        $.ajax({
            url: $(this).data("href"),
            dataType: "html",
            success: function(result) {
                $(container).html(result).modal('show');
            }
        });
    });
})