<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MlModelStateRequest extends FormRequest
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
            'params'          => 'required',
            'ml_model_id'     => 'required',
            'ml_algorithm_id' => 'required',
            //'file'            => 'required',
        ];
    }

    public function messages()
    {
        return [
            'params.required'          => 'Provide the model training parameters.',
            'ml_model_id.required'     => 'Provide a parent model.',
            'ml_algorithm_id.required' => 'Provide a prediction algorithm.',
            //'file.required'            => 'Provide a training data file.'
        ];
    }
}
