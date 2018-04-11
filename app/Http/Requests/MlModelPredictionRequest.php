<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MlModelPredictionRequest extends FormRequest
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
            'ml_model_id' => 'required',
            'file'        => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ml_model_id.required' => 'Provide a parent model.',
            'file.required'        => 'Provide a unlabeled data file.'
        ];
    }
}
