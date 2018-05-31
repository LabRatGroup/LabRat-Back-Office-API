<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectTeamRequest extends FormRequest
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
            'team_id'    => 'required',
            'project_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'team_id.required'    => 'Team is required.',
            'project_id.required' => 'Project is required.',
        ];
    }
}
