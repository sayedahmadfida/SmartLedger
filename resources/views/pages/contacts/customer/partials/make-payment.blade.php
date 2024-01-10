<div class="modal-dialog modal-lg box box-solid box-primary" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Make Transaction</h4>
        </div>

        <form action="{{ route('credit.store') }}" id="make_invoice_payment" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="customer_id" id="sale_customer_id"
                    value="{{ $customerId->customer_id }}">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="invoice_date"> Date</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" name="created_at" value="@format_date(now)"
                                placeholder="Date" id="purchase_invoice_date">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="payment_amount">Amount:*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                {{ session('user.currency_symbol') }}
                            </span>
                            <input type="number" name="paid_amount"
                                id="payment_amount" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="money_resource">Money Resource:*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-building-o"></i>
                            </span>
                            <select name="money_resources_id" id="money_resource" class="form-control">
                               @foreach ($money_resources as $resourse)
                                    <option value="{{ $resourse->id }}">
                                        {{ $resourse->resourse_type }} - {{ $resourse->resourse_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="money_resource">Money Resource:*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-building-o"></i>
                            </span>
                            <select name="type" id="money_resource" class="form-control">
                                <option value="CREDIT">Credit</option>
                                <option value="DEBIT">Debit</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="payment_description">Credit Description: </label>
                        <textarea name="paid_description" id="payment_description" placeholder="Credit Description..."
                            cols="30" rows="4" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    $("#purchase_invoice_date").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        immediateUpdates: true,
        todayBtn: true,
        todayHighlight: true,
    });
    $(document).on('keyup', '#payment_amount', function(e) {
        
    });
    $("#make_invoice_payment").validate({
        rules: {
            paid_amount: { required: true },
            money_resources_id: { required: true },
            paid_description: { required: true },
        },
        messages: {
            paid_amount: {
                required: "Please Enter Paid Amount!",
            },
            money_resources_id: {
                required: "Please Select Money Resource!",
            },
            paid_description: {
                required: "Please Enter Discription!",
            },
        },
    });


</script>
