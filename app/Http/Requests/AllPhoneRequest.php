<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AllPhoneRequest extends FormRequest
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
            'phone' => 'required|max:20|min:10',
            
        ];
    }
    public function messages(){
        return[
            'phone.required' => 'Require to fill!',
            'phone.max' => 'Must be less then 20 characters',
            'phone.min' => 'Must be Greater then 10 characters',
          ];
    }
}
