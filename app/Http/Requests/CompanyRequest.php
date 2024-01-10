<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'company_name' => 'required|max:50|min:3',
            'company_phone' => 'required|max:30|min:10',
            'company_email' => 'required|max:50|min:3',
            'country' => 'required|max:50|min:3',
            'company_province' => 'required|max:50|min:3',

        ];
    }
    public function messages(){
        return[
            'company_name.required' => 'Require to fill!',
            'company_name.max' => 'Must be less then 50 characters',
            'company_name.min' => 'Must be Greater then 3 characters',
            'company_phone.required' => 'Require to fill!',
            'company_phone.max' => 'Must be less then 15 characters',
            'company_phone.man' => 'Must be Greater then 10',
            'company_email.required' => 'Require to fill!',
            'company_email.max' => 'Must be less then 50 characters',
            'company_email.min' => 'Must be Greater then 3 characters',
            'country.required' => 'Require to fill!',
            'country.max' => 'Must be less then 50 characters',
            'country.min' => 'Must be Greater then 3 characters',
            'company_province.required' => 'Require to fill!',
            'company_province.max' => 'Must be less then 50 characters',
            'company_province.min' => 'Must be Greater then 3 characters',
        ];
    }
}
