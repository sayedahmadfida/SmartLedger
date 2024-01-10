<div class="modal fade show_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

</div>
<form action="" target="_blank" method="POST" id="">
    @csrf
    <input type="hidden" name="customer_id" value="{{ Crypt::encrypt($customer->id) }}">
</form>



<span class="hidden" id="customer-name">{{ $customer->customer_name }}</span>
<form action="{{ route('decleration-date.store') }}" method="POST" id="cleare-account-form">
    <div class="modal-body">
        @csrf
        <input type="hidden" id="customer_id" name="modal_id"
            value="{{ Crypt::encrypt($customer->id) }}">
    </div>
</form>