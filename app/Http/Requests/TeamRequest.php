<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'name' => 'required|min:5|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Team name is required.',
            'name.min'      => 'Team name must be at least 5 character length.',
            'name.,ax'      => 'Team name must not exceed the 255 character length.',
        ];
    }
}
