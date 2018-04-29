<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MlModelRequest extends FormRequest
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
            'title'      => 'required|min:5|max:255',
            'project_id' => 'required',
            'positive'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'      => 'Model title is required.',
            'title.min'           => 'Model title must be at least 5 character length.',
            'title.max'           => 'Model title must not exceed the 255 character length.',
            'project_id.required' => 'Please provide a project to associate this model to.',
            'positive.required'   => 'Please provide the data field stated as positive value.',
        ];
    }
}
