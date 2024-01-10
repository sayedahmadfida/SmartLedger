$(document).ready(function () {
    $('.print_btn').on('click', function (e) {
        $('#report_frm').submit();
    })


    var supplier_report_table = $('#supplier_report_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/reports/suppliers",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                searchable: false,
            },
            {
                data: "ltd_name",
                name: "ltd_name",
            },
            {
                data: "purchased",
                name: "purchased",
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
        listBy(supplier_report_table, 'ltd_country', $(this).val());
        setProvinces(e.target.value)
    })
    $(document).on('change', '#list_by_province', function (e) {
        listBy(supplier_report_table, 'ltd_province', $(this).val());
        setStates(e.target.value)
    })
    $(document).on('change', '#list_by_state', function (e) {
        listBy(supplier_report_table, 'ltd_street', $(this).val());
    })


})

function listBy(table, listBy, value) {
    table.ajax
        .url(
            "/reports/suppliers?listBy=" +
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
    $.getJSON('suppliers/listProvinces/' + country, function (data) {
        data.forEach(provnice => {
            console.log(provnice.ltd_province);
            $('#list_by_province').append('<option value="' + provnice.ltd_province + '">' + provnice.ltd_province + '</option>')
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
    $.getJSON('suppliers/listStates/' + province, function (data) {
        console.log(data);
        data.forEach(states => {
            $('#list_by_state').append('<option value="' + states.ltd_street + '">' + states.ltd_street + '</option>')
        });
    })
}