<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductDetialsRequest extends FormRequest
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
            'product_id' => 'required',
            // 'currency_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Please Select Product!',
            // 'currency_id.required' => 'Please Select Currency!',
            'quantity.required' => 'Please Enter Product Quantity!',
            'price.required' => 'Please Enter Product Price!',
            'sale_price.required' => 'Please Enter Product Sale Price!',
        ];
    }
}
