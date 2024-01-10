<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'customer_name' => 'required|min:3',
            'customer_country'  => 'required',
            'customer_province' => 'required|min:5',
            'customer_village'  => 'required',
            'identity_card' => 'required|min:5',
        ];
    }

    public function messages()
{
    return [
        'customer_name.required' => 'Please Add Customer Name',
        'customer_name.min' => 'Please Insert at least 3 Characters',
        'customer_country.required' => 'Please Select Customer Country ',
        'customer_province.required' => 'Please Add Country Province',
        'customer_province.min' => 'Please Insert at least 5 Characters',
        'customer_village.required' => 'Please Add Customer ShopNo#',
        // 'customer_village.min' => 'Please Insert at least 5 Characters',
        'identity_card.required' => 'Please Add Customer Identity Card',
        'identity_card.min' => 'Please Insert at least 5 Characters',
    ];
}
}
