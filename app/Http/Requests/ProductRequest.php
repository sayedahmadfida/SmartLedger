<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|min:3|max:50',
            'sub_category_id' => 'required',
            'unite_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Please Enter Product Name!',
            'product_name.min' => 'Enter at least 3 Characters!',
            'product_name.max' => 'Enter Less then 50 Characters!',
            'sub_category_id.required' => 'Please Select Sub Category!',
            'unite_id.required' => 'Please Select Unit!',
        ];
    }
}
