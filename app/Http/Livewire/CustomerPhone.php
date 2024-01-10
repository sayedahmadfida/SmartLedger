<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;


class CustomerPhone extends Component
{
    public $phoneInputs = [];
    public $isUpdateState = false;
    public $phoneNoCount;
    public $customer_id = 0;
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

    public function incrementEditPhone()
    {
    }

    public function render()
    {
        return view('livewire.customer-phone');
    }
}
