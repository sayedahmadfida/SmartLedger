<div>
    @foreach ($phoneInputs as $inputs)
         
    <div class="row margin-bottom">
        <div class="col-sm-10">
            {{-- @if ($inputs != 'customer_phone')
             <input type="text" name="addMorePhone[]"  class="form-control" placeholder="Phone Number">                
            @else --}}
            <input type="text" name="addMorePhone[]" value="{{$inputs['customer_phone']}}" class="form-control" placeholder="Phone Number">                
            {{-- @endif --}}
        </div>
        <button class="btn btn-danger" wire:click="decrement({{$loop->index}})" id="" type="button"><span class="glyphicon glyphicon-minus"></span></button>
    </div>
    @endforeach
    <button class="btn col-sm-10 btn-primary" wire:click="increment" id="addPhoneInput" type="button"><span class="glyphicon glyphicon-plus"></span> Add Phone</button>
</div>
