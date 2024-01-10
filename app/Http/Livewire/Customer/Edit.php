<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

class Edit extends Component
{


    public $phoneInputs = [];

    public function mount($phoneInputs)
    {
        $this->phoneInputs = $phoneInputs->toArray();
        // dd(count($this->phoneInputs));
    }
    
    public function increment()
    {
        $this->phoneInputs[] = count($this->phoneInputs);
    }

    public function decrement($index)
    {
        unset($this->phoneInputs[$index]);
    }

    public function render()
    {
        return view('livewire.customer.edit');
    }
}
