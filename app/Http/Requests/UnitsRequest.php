<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitsRequest extends FormRequest
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
            'main_name' => 'required|min:3',
            'short_name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'main_name.required' => 'Please Enter Main Name',
            'main_name.min' => 'Please Enter More then 3 Characters',
            'short_name.required' => 'Please Enter Short Name',

        ];
    }
}
