<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class APIRegisterRequest extends FormRequest
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
            'email'    => 'required|string|email|max:255|unique:users',
            'name'     => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.unique:users' => 'A user with the provided email address already exists.',
        ];
    }
}
