<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'name'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Provide an email account.',
            'email.email'    => 'A valid email account is required.',
            'email.max'      => 'Email account should not exceed the 255 characters. .',
            'name.required'  => 'User full name is required.',
        ];
    }
}
