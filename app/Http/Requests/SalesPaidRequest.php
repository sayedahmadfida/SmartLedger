<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesPaidRequest extends FormRequest
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
            'paid_amount' => 'required',
            'money_resources_id' => 'required',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'paid_amount.required' => 'Please Enter Paid Amount!',
            'money_resources_id.required' => 'Please Select Money Resource',
        ];
    }
}
