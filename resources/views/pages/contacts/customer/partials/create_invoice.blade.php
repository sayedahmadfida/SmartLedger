<div class="modal-dialog modal-xl create_invoiceModal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Create New Invoice</h4>
        </div>
        <div class="modal-body">
            <div class="box-body" style="">
                <form action="{{ route('sale-invoice.store') }}" id="create_invoice_form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="customer_id"> Customer</label><br>
                                <h4>{{ $customers->customer_name }}</h4>

                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="invoice_currency_id"> Currency</label>
                                <select class="form-control" name="currency_id" id="invoice_currency_id">
                                    @foreach ($currencies as $currency)
                                        <option data-symbol="{{ $currency->symbol }}" value="{{ $currency->id }}">
                                            {{ $currency->currency }}
                                            ({{ $currency->code }} - {{ $currency->symbol }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="currency_id"> Inoivce No</label>
                                <input type="text" name="bill_number" placeholder="Inovoice Number"
                                    class="form-control" id="inovice_no">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="invoice_date"> Date</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" name="created_at"
                                        value="@format_date(now)" placeholder="Date" id="invoice_date">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="box-footer invoice_btn">
                <button type="submit" class="btn btn-primary pull-right btn-flat btn_save_product">
                    Create Invoice
                </button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Invoice Details --}}
<div class="modal-dialog modal-xl invoice_dataTable hidden" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Invoice</h4>
        </div>
        <div class="model-body">

            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" placeholder="Search Product" class="form-control"
                                        id="search_product">
                                    <span class="input-group-btn">
                                        <a href="{{ route('productList.create') }}" tabindex="-1" type="button"
                                            class="btn btn-primary btn-modal" data-href="#"
                                            data-container=".quick_add_product_modal"><i class="fa fa-plus"></i> Add New
                                            Product
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('sale-invoice.store') }}" method="POST" id="sale_form">
                        @csrf
                        <div class="form_row row ">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Product Name <i
                                            class="fa fa-commenting cursor-pointer text-primary add-pos-row-description"
                                            title="Add Description" data-toggle="modal"
                                            data-target="#row_description_modal_1"></i></label><br>
                                    <h5 class="product_name">Product </h5>
                                    <input type="hidden" name="product_id" id="product_id">
                                    <input type="hidden" name="in_stock_id" id="stock_id">
                                    <input type="hidden" name="in_stock_qty" id="in_stock_qty">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Quantity:*</label>
                                    <div class="input-group">
                                        <input type="number" name="quantity" id="quantity" placeholder="Quantity"
                                            class="form-control" onkeyup="setGrandTotal()"
                                            onchange="setGrandTotal()">
                                        <span class="input-group-addon">
                                            <label for="" class="product_unit_label">PS</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Price:*</label>
                                    <div class="input-group">
                                        <input type="number" name="price" id="price"
                                            onkeyup="setGrandTotal()" onchange="setGrandTotal()" placeholder="Price"
                                            class="form-control">
                                        <span class="input-group-addon">
                                            <label
                                                class="purchase_invoice_currency">{{ $currencies[0]['symbol'] }}</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Cost:</label>
                                    <div class="input-group">
                                        <input disabled type="text" id="unit_cost" name="cost_price"
                                            placeholder="Cost" class="form-control">
                                        <span class="input-group-addon">
                                            <label
                                                class="purchase_invoice_currency">{{ $currencies[0]['symbol'] }}</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="warehouse_id" id="warehouse_id">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Grand Total</label>
                                    <div class="input-group">
                                        <input disabled placeholder="Grand Total" id="grand_total" name="grand_total"
                                            type="text" class="form-control">
                                        <span class="input-group-addon">
                                            <label class="purchase_invoice_currency">{{ $currencies[0]['symbol'] }}</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-social btn-bitbucket btn_save_sale ">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </div>
                            <div class="properties_values"></div>
                        </div>
                        <div class="table-responsive sale_add_invoice_table">
                            <table class="table table-striped small " id="product_sold_table">
                                <thead>
                                    <th>No#</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Grand Total</th>
                                    <th>Warehouse</th>
                                    <th>Action</th>
                                </thead>
                            </table>
                        </div>
                </div> {{-- box-body --}}
                <div class="box-footer">

                    <div class="pull-right col-md-5">
                        <div class=" pull-right">
                            <table class="table">
                                <tr>
                                    <td class="pull-right">
                                        <strong>Invoice Total:</strong>
                                    </td>
                                    <td><span class="invoice_currency"></span> <span class="invoice_total">0.00</span>
                                    </td>
                                </tr>
                            </table>
                            <a href="#" class=" btn pull-right">
                                <i class="text-primary glyphicon glyphicon-print" style="font-size: 30px"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div> {{-- box-body --}}
        </div>
    </div>
</div>

<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var unit_cost = 0;
        $("form#sale_form")
            .submit(function(e) {
                e.preventDefault();
            })
            .validate({
                rules: {
                    product_id: {
                        required: true,
                    },
                    quantity: {
                        required: true,
                        maxlength: 11,
                    },
                    price: {
                        required: true,
                        maxlength: 11,
                    },
                    cost_price: {
                        required: true,
                        maxlength: 11,
                    },
                    grand_total: {
                        required: true,
                    },
                },
                messages: {
                    product_id: {
                        required: "Please Select Product",
                    },
                    quantity: {
                        required: "Enter At lease 1 Character!",
                        maxlength: "No more then 11 Character!",
                     },
                    price: {
                        required: "Please Enter Product Price!",
                        maxlength: "No more then 11 Character!",
                    },
                    cost_price: {
                        required: "Please Enter Product Unit Cost!",
                        maxlength: "No more then 11 Character!",
                    },
                },
                submitHandler: function(form) {
                    var data = $(form).serialize() + "&cost_price=" + unit_cost;
                    $.ajax({
                        method: "POST",
                        url: $(form).attr("action"),
                        dataType: "json",
                        data: data,
                        success: function(result) {
                            if (result.segment == "edit") {
                                window.location.href = "/saleproduct";
                            }
                            $(form).each(function() {
                                this.reset();
                            });
                            $(".product_name").html("Product Name");

                            $("#product_id").val("");
                            product_sold_table.ajax.reload();
                            $(".invoice_total").html(result.invoice_total);

                            $(".net_amount").html(
                                result.invoice_total - result.total_paid
                            );
                        },
                        error: function(error) {
                            toastr.error(
                                "something went wrong! Please Check Inputs"
                            );
                            console.log(error);
                        },
                    });
                },
            });
        $("#invoice_date").datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            immediateUpdates: true,
            todayBtn: true,
            todayHighlight: true,
        });

        $("form#create_invoice_form")
            .submit(function(e) {
                e.preventDefault();
            })
            .validate({
                rules: {
                    customer_id: "required",
                    currency_id: "required",
                },
                messages: {
                    customer_id: "Please Select LTD!",
                    currency_id: "Please Select Currency!",
                },
                submitHandler: function(form) {
                    var data = $(form).serialize() + "&customer_id=" + {{ $id }};
                    console.log(data);
                    $.ajax({
                        method: "POST",
                        url: $(form).attr("action"),
                        dataType: "json",
                        data: data,
                        success: function(result) {
                            console.log(result);
                            if (result.success == true) {
                                console.log(result);
                                // $(".invoice_btn").remove();
                                toastr.success(result.msg);
                            }
                        },
                        error: function(error) {
                            toastr.error(
                                "something went wrong! Please Check Inputs"
                            );
                            console.log(error);
                        },
                    });
                },
            });
        $(document).on('click', '.btn_save_product', function(e) {
            $('form#create_invoice_form').submit();
            $(".create_invoiceModal").remove();
            $(".invoice_dataTable").removeClass("hidden");
        })
        $(document).on('click', '.btn_save_sale', function(e) {
        })

        $("#search_product")
            .autocomplete({
                source: function(request, response) {
                    $.getJSON(
                        "/stoke_products/", {
                            like_product: $("input#search_product").val(),
                        },
                        response
                    );
                },
                minLength: 2,
                response: function(event, ui) {
                    console.log(ui);
                },
                select: function(event, ui) {
                    if (ui.item.quantity <= 0) {
                        toastr.error("This Product is out of Stock");
                    } else {
                        console.log(ui.item.product_name);
                        get_product_properties_for_input(ui.item.id);
                        $("#product_id").val(ui.item.id);
                        $("#unit_cost").val(ui.item.unit_cost);
                        $("#price").val(ui.item.sale_price);
                        $("#stock_id").val(ui.item.stock_id);
                        $("#warehouse_id").val(ui.item.warehouse_id);
                        $("#in_stock_qty").val(ui.item.quantity);
                        $(".product_name").html(
                            ui.item.product_name + "-" + ui.item.sub_category_name
                        );
                        unit_cost = ui.item.unit_cost;
                    }
                },
            })
            .autocomplete("instance")._renderItem = function(ul, item) {
                console.log(ul);
                if (item.quantity <= 0) {
                    var string = '<li class="ui-state-disabled">' + item.product_name;
                    string += "<small>" + item.sub_category_name + "</small>";
                    string += "<br> Price: " + item.price + " (Out of stock) </li>";
                    return $(string).appendTo(ul);
                } else {
                    var string = "<div>" + item.product_name;
                    string += "<small> " + item.sub_category_name + "</small>";
                    string +=
                        "<br>Sale Price: " +
                        item.sale_price +
                        " (In Stock: " +
                        item.quantity +
                        " - " +
                        item.short_name +
                        " ) </div>";
                    return $("<li>").append(string).appendTo(ul);
                }
            };


        var product_sold_table = $("#product_sold_table").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            paging: false,
            info: false,
            ajax: "/get_sold_product",
            aaSorting: [
                [1, "asc"]
            ],
            columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    searchable: false,
                },

                {
                    data: "product_name",
                    name: "product_name"
                },
                {
                    data: "quantity",
                    name: "quantity"
                },
                {
                    data: "price",
                    name: "price"
                },
                {
                    data: "grand_total",
                    name: "grand_total"
                },
                {
                    data: "warehouse",
                    name: "warehouse"
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
            createdRow: function(row, data, dataIndex) {
                $(row)
                    .find("td:eq(0)")
                    .prepend(
                        '<i style="margin:auto;" class="fa fa-plus-circle text-success cursor-pointer no-print product-properties" title=""></i>&nbsp;&nbsp;'
                    );
            },
            order: [
                [1, "asc"]
            ],
        });

    })

    function get_product_properties_for_input(pro_id) {
        $.ajax({
            method: "POST",
            url: "/product/get_props",
            dataType: "html",
            data: {
                product_id: pro_id,
                _token: $("input[name='_token']").val(),
            },
            success: function(result) {
                if (result) {
                    $(".inputs-group").append($(".properties_values").html(result));
                } else {
                    $(".properties_values").html("");
                }
            },
            error: function(error) {
                console.log(error);
            },
        });
    }

    function setGrandTotal() {
        var quantity = $("#quantity").val();
        $.ajax({
            url: "/available-stock",
            type: "post",
            data: {
                stock_id: function() {
                    return $("#stock_id").val();
                },
                _token: function() {
                    return $("input[name=_token]").val();
                },
                pos_quantity: function() {
                    return quantity;
                },
            },
            success: function(result) {
                // console.log(result);
                var form_validate = $("form#sale_form").validate();
                if (result.status) {
                    $("#quantity").each(function() {
                        $(this).rules("add", {
                            max: result.max_quantity,
                            messages: {
                                max: result.msg,
                            },
                        });
                    });
                }
            },
        });
        // $("form#sale_form").validate();

        var quantity = $("#quantity").val();
        var price = $("#price").val();

        var grand_total = quantity * price;

        $("#grand_total").val(grand_total);
    }
</script>
