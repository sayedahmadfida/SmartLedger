<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequset extends FormRequest
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
            'first_name' => 'required|min:4',
            'last_name' => 'required|min:4',
            'email' => 'required|email',
            'username' => 'required|min:3|max:20',
            'new_password' => 'required|min:8',
            'retype_password' => 'required|min:8|required_with:new_password|same:new_password',
        ];

    }

    /**
     *  Get The error Messages for the defined validation rules
     *
     *  return array
     */
    public function messages()
    {
        return [
            'first_name.required' => "Please Insert the First Name",
            'first_name.min' => "Please More then 4 charecter",
            'last_name.required' => "Please Enter Last Name",
            'last_name.min' => "Please More then 4 charecter",
            'email.required' => "Please Enter Email Address",
            'email.email' => "Please Enter Valid Email",
            'username.requried' => "Please Enter Username",
            'username.min' => "Please Enter More Then 3 Characters",
            'username.max' => "Please Enter Less Then 20 Characters",
            'new_password.required' => "Please Enter Password",
            'new_password.min' => "Your password must be at least 8 characters long",
            'retype_password.required' => "Please Enter Retype Password agin",
            'retype_password.min' => "Please Enter Retype Password at least 8 characters long ",
            'retype_password.required_with' => "Please enter the same password as New Password",
        ];
    }
}
