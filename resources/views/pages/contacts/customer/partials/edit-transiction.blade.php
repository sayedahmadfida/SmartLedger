<div class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"
    id="edit-transiction-modal{{ $item->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Transaction</h4>
            </div>

            <form action="{{route('transaction.update', Crypt::encrypt($item->id))}}" method="POST" class="edit-transaction">
               
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <input type="hidden" name="customer_id" id="sale_customer_id" value="1">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="invoice_date"> Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" value="{{$item->created_at}}" class="form-control" name="created_at" value="2023-11-16"
                                    placeholder="Date" id="purchase_invoice_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="payment_amount">Amount:*</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    {{session('user.currency_symbol')}}
                                </span>
                                <input type="number" value="{{$item->transiction_type == 'CREDIT' ? $item->credit_amount : $item->debit_amount}}" name="amount" id="payment_amount"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="credit-type">Transaction Type:*</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa-regular fa-credit-card"></i>
                                </span>
                                <select name="type" id="credit-type" class="form-control">
                                    <option value="CREDIT" {{$item->transiction_type == 'CREDIT' ? 'selected' : null}}>Credit</option>
                                    <option value="DEBIT" {{$item->transiction_type == 'DEBIT' ? 'selected' : null}}>Debit</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="payment_description">Transaction Description: </label>
                            <textarea name="transactionDescription" id="payment_description" placeholder="Credit Description..." cols="30"
                                rows="4" class="form-control">{{$item->transaction_description}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>


        </div>
    </div>

</div>
