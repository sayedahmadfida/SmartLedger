<div class="widget-user-header bg-navy">
  <h3 class="">{{ $customer->customer_name }}</h3>
  <h5 class="">
      {{ $customer->customer_country . ', ' . $customer->customer_province . ', ' . $customer->customer_state }}
  </h5>
</div>
<div class="modal fade in" id="add_model" style="display: none;">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Add New Phone</h4>
          </div>
          <form action="{{ route('phone.store') }}" method="post" id="phone-form">
              @csrf
              <div class="modal-body">
                  <input type="hidden" name="model_id" value="{{ Crypt::encrypt($customer->id) }}">
                  <input type="hidden" name="model_type" value="{{ Crypt::encrypt('CUSTOMER') }}">

                  <input type="text" class="form-control" name="phone" placeholder="Phone">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save </button>
              </div>
          </form>
      </div>
    </div>
</div>