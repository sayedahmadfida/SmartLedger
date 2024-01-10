<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

class Create extends Component
{
       public $phoneInputs = [];
    public $isUpdateState = false;
    public $phoneNoCount;
    public $testPhoneId = 0;

    public function increment()
    {
        $this->phoneInputs[] = count($this->phoneInputs) + 1;
    }

    public function decrement($index)
    {
        unset($this->phoneInputs[$index]);
    }

    public function deletePhone($index, $phone_id)
    {
        Customer::find($this->customer_id)->phone()->where('id', $phone_id)->delete();
        unset($this->phoneInputs[$index]);
    }

    public function render()
    {
        return view('livewire.customer.create');
    }
}
