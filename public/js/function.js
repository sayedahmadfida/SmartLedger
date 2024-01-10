

function urlRequest(node) {
	$(document).on("click", node, function (e) {
		e.preventDefault();
		var container = $(this).data("container");
		console.log(container);
		$.ajax({
			url: $(this).data("url"),
			dataType: "html",
			success: function (result) {
				// console.log(result);
				$(container).html(result).modal("show");
			},
			error: function (error) {
				console.log(error);
			},
		});
	});
}

function showLoader() {
	$('#cover-spin').show(0);
}

function hideLoader() {
	$('#cover-spin').hide(0);
}

function dataTableButtons() {
	jQuery.extend($.fn.dataTable.defaults, {
		dom: '<"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right margin-left-10"B><"pull-right"fr>>>tip',
		buttons: [
			{
				extend: 'collection',
				text: '<i class="fa fa-list" aria-hidden="true"></i> &nbsp; Action',
				className: 'btn-info',
				init: function (api, node, config) {
					$(node).removeClass('btn-default')
				},
				buttons: [
					{
						extend: 'copy',
						text: '<i class="fa fa-files-o" aria-hidden="true"></i> Copy',
						className: 'bg-info',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'csv',
						text: '<i class="fa fa-file-text-o" aria-hidden="true"></i> Export To CSV',
						className: 'bg-info',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'excel',
						text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export To Excel',
						className: 'bg-info',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'pdf',
						text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export To PDF',
						className: 'bg-info',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'print',
						text: '<i class="fa fa-print" aria-hidden="true"></i> Print',
						className: 'bg-info',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'colvis',
						text: '<i class="fa fa-columns" aria-hidden="true"></i>  Column visibility',
						className: 'bg-info',
					},
				]
			}
		],
		aLengthMenu: [
			[25, 50, 100, 200, -1],
			[25, 50, 100, 200, 'All']
		],
		iDisplayLength: 25,

	});
}