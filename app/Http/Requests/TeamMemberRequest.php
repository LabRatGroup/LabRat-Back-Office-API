<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamMemberRequest extends FormRequest
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
            'user_id'  => 'required',
            'team_id'  => 'required',
            'is_owner' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required'  => 'Member is required.',
            'team_id.required'  => 'Team is required.',
            'is_owner.required' => 'Please define if new user will be an owner of this team.',
        ];
    }
}
