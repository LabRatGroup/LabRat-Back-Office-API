<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    use ApiRequest;

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
            'email'    => 'required|email|max:255|unique:users',
            'name'     => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Provide an email account.',
            'email.email'       => 'A valid email account is required.',
            'email.max'         => 'Email account should not exceed the 255 characters. .',
            'email.unique'      => 'There is already registered user with that email account.',
            'name.required'     => 'User full name is required.',
            'password.required' => 'An account access password is required.'
        ];
    }
}
