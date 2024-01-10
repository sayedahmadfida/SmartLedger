    <form action="{{route('transaction.destroy', Crypt::encrypt( $item->id))}}" method="POST" id="delete-form-{{$item->id}}">
        @csrf
        @method('DELETE')
    
        <input type="hidden" value="{{ $item->transiction_type == 'CREDIT' ? $item->credit_amount : $item->debit_amount }}" data-amount="delete-form-{{$item->id}}">
        
    </form>