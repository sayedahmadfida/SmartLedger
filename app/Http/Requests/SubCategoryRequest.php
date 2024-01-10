<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'sub_category' => 'required|max:50|min:3',

        ];
    }
    public function messages(){
        return[
            'sub_category.required' => 'Require to fill!',
            'sub_category.max' => 'Must be less then 50 characters',
            'sub_category.min' => 'Must be Greater then 3 characters'
        ];
    }
}
