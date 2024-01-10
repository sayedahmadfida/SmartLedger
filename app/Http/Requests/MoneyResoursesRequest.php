<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoneyResoursesRequest extends FormRequest
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
            'money_resource_date' => 'required|max:50|min:3',
            'type' => 'required|max:8|min:4',
            'name' => 'required|max:50|min:3',

        ];
    }
    public function messages(){
        return[
            'money_resource_date.required' => 'Require to fill!',
            'money_resource_date.max' => 'Must be less then 50 characters',
            'money_resource_date.min' => 'Must be Greater then 3 characters',
            'type.required' => 'Require to fill!',
            'type.max' => 'Must be less then 15 characters',
            'type.man' => 'Must be Greater then 10',
            'name.required' => 'Require to fill!',
            'name.max' => 'Must be less then 50 characters',
            'name.min' => 'Must be Greater then 3 characters'
        ];
    }
}
