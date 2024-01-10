<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseInvoiceRequest extends FormRequest
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
            'ltd_id' => 'required',
            'currency_id' => 'required',
            'invoice_number' => 'required|max:11',
        ];

    }


    public function messages(){
        return [
            'ltd_id.required' => 'Please Select LTD!',
            'currency_id.required' => 'Please Select Currency!',
            'invoice_number.required' => 'Enter At lease 1 Character!',
            'invoice_number.max' => 'No more then 11 Character!',
        ];
    }
}
