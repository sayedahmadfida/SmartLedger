<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'warehouse_name' => 'required|max:50|min:3',
            'warehouse_address' => 'required|max:30|min:10',
            'warehouse_phone' => 'required|max:15|min:10'
        ];
    }
    public function messages(){
        return[
            'warehouse_name.required' => 'Require to fill!',
            'warehouse_name.max' => 'Must be less then 50 characters',
            'warehouse_name.min' => 'Must be Greater then 3 characters',
            
            'warehouse_address.required' => 'Require to fill!',
            'warehouse_address.max' => 'Must be less then 15 characters',
            'warehouse_address.man' => 'Must be Greater then 10',
       
            'warehouse_phone.required' => 'Require to fill!',
            'warehouse_phone.max' => 'Must be less then 15 characters',
            'warehouse_phone.man' => 'Must be Greater then 10'
       
        ];
    }
}
