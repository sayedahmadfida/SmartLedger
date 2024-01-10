$(document).ready(function () {
    $('.print_btn').on('click', function (e) {
        $('#report_frm').submit();
    })


    var customer_report_table = $('#customer_report_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/reports/customers",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                searchable: false,
            },
            {
                data: "customer_name",
                name: "customer_name",
            },
            {
                data: "sold",
                name: "sold",
            },
            {
                data: "paid",
                name: "paid",
            },
            {
                data: "due",
                name: "due",
            },
        ],
    });
    $(document).on('change', '#list_by_country', function (e) {
        listBy(customer_report_table, 'customer_country', $(this).val());
        setProvinces(e.target.value)
    })
    $(document).on('change', '#list_by_province', function (e) {
        listBy(customer_report_table, 'customer_province', $(this).val());
        setStates(e.target.value)
    })
    $(document).on('change', '#list_by_state', function (e) {
        listBy(customer_report_table, 'customer_village', $(this).val());
    })


})

function listBy(table, listBy, value) {
    table.ajax
        .url(
            "/reports/customers?listBy=" +
            listBy +
            "&value=" +
            value
        )
        .load();
}

function setProvinces(country) {
    $('#list_by_province').removeAttr('disabled');
    $('#list_by_province')
        .find('option')
        .remove()
        .end()
        .append('<option selected disabled> Select Province</option>');
    $.getJSON('customers/listProvinces/' + country, function (data) {
        data.forEach(provnice => {
            $('#list_by_province').append('<option value="' + provnice.customer_province + '">' + provnice.customer_province + '</option>')
        });
    })
}

function setStates(province){
    $('#list_by_state').removeAttr('disabled');
    $('#list_by_state')
        .find('option')
        .remove()
        .end()
        .append('<option selected disabled> Select State</option>');
    $.getJSON('customers/listStates/' + province, function (data) {
        data.forEach(states => {
            $('#list_by_state').append('<option value="' + states.customer_village + '">' + states.customer_village + '</option>')
        });
    })
}