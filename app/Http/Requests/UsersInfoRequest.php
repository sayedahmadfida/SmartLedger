<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersInfoRequest extends FormRequest
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
            'userCountry' => 'required|max:50|min:3',
            'userProvince' => 'required|max:30|min:3',
            'userAddress' => 'required|max:50|min:3',
            'invoiceAddress' => 'required|max:50|min:3',
        ];
    }
    public function messages(){
        return[
            'userCountry.required' => 'Require to fill!',
            'userCountry.max' => 'Must be less then 50 characters',
            'userCountry.min' => 'Must be Greater then 3 characters',
            'userProvince.required' => 'Require to fill!',
            'userProvince.max' => 'Must be less then 15 characters',
            'userProvince.man' => 'Must be Greater then 10',
            'userAddress.required' => 'Require to fill!',
            'userAddress.max' => 'Must be less then 50 characters',
            'userAddress.min' => 'Must be Greater then 3 characters',
            'invoiceAddress.required' => 'Require to fill!',
            'invoiceAddress.max' => 'Must be less then 50 characters',
            'invoiceAddress.min' => 'Must be Greater then 3 characters',
          ];
    }
}
