<div class="modal fade in" id="create-customer">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">New Customer</h4>
            </div>
            <form action="{{ route('customer.store') }}" method="post" id="customer_frm">
                @csrf
                
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Customer Name:*</label>
                            <input type="text" name="name" class="form-control" placeholder="Customer Name">
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Identity Card No:</label>
                            <input type="text" name="identity_card" class="form-control" placeholder="Identity Card No">
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Phone Number:*</label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Country:*</label>
                            <select name="country" class="form-control customer_country">
                                @foreach ($countries as $list)
                                <option value="{{ $list->name }}">{{ $list->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Province</label>
                            <input type="text" name="province" class="form-control" placeholder="Province">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>State:</label>
                            <input type="text" name="state" class="form-control" placeholder="State">
                        </div>
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