<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class moneyResourseDetailsRequest extends FormRequest
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
            'country' => 'required|max:50|min:3',
            'province' => 'required|max:20|min:3',
            'shop_number' => 'required|max:10|min:1',
            'phone' => 'required|max:30|min:10',
            'account' => 'required|max:50|min:3',
            
        ];
    }
    public function messages(){
        return[
            'country.required' => 'Require to fill!',
            'country.max' => 'Must be less then 50 characters',
            'country.min' => 'Must be Greater then 3 characters',
            
            'province.required' => 'Require to fill!',
            'province.max' => 'Must be less then 20 characters',
            'province.man' => 'Must be Greater then 3',
            
            'shop_number.required' => 'Require to fill!',
            'shop_number.max' => 'Must be less then 10 characters',
            'shop_number.min' => 'Must be Greater then 3 characters',
            
            'phone.required' => 'Require to fill!',
            'phone.max' => 'Must be less then 30 characters',
            'phone.min' => 'Must be Greater then 10 characters',

            'account.required' => 'Require to fill!',
            'account.max' => 'Must be less then 50 characters',
            'account.min' => 'Must be Greater then 3 characters'
        ];
    }
}
