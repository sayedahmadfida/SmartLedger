<div class="modal fade in" id="transaction-model">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Transaction</h4>
        </div>

        <form action="{{ route('transaction.store') }}" method="POST" id="make-transaction">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="model_id" id="model-id">   
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
                        <label for="transaction-amount">Amount:*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                {{ session('user.currency_symbol') }}
                            </span>
                            <input type="number" name="amount" placeholder="0.0" id="transaction-amount" class="form-control">
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="Transaction-type">Transaction Type:*</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa-regular fa-credit-card"></i>
                            </span>
                            <select name="type" id="Transaction-type" class="form-control">
                                <option value="CREDIT">Credit</option>
                                <option value="DEBIT">Debit</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="Transaction-description">Credit Description: </label>
                        <textarea name="transictionDescription" id="Transaction-description" placeholder="Credit Description..."
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
</div>

