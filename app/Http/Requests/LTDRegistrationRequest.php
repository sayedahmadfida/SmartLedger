<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LTDRegistrationRequest extends FormRequest
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
            'ltd_name' => 'required|min:3|max:100',
            'ltd_country' => 'required',
            'ltd_province' => 'required|min:3|max:100',
            'ltd_street' => 'required|min:3|max:50',
            'ltd_shop' => 'required|max:50',
            // 'addMorePhone' => 'required|min:10|max:30',
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
            'ltd_name.required' => "Please Add LTD Name!",
            'ltd_name.min' => "Please at least 3 Charecters",
            'ltd_name.max' => "Please less then 50 Charecters",
            'ltd_country.required' => "Please Select Country!",
            'ltd_province.required' => "Please Add LTD Province!",
            'ltd_province.min' => "Please at least 3 Charecters",
            'ltd_province.max' => "Please less then 50 Charecters",
            'ltd_street.required' => "Please Add LTD Address Street!",
            'ltd_street.min' => "Please at least 3 Charecters",
            'ltd_street.max' => "Please less then 50 Charecters",
            'ltd_shop.required' => "Please Add LTD Shop Number!",
            'ltd_shop.max' => "Please less then 50 Charecters",
            // 'addMorePhone.required' => "Please Add LTD Phone Number!",
            // 'addMorePhone.min' => "Please at least 10 Charecters",
            // 'addMorePhone.max' => "Please less then 30 Charecters",
        ];
    }
}
