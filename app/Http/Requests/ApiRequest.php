<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

trait ApiRequest
{
    protected function failedValidation(Validator $validator)
    {
        $message = (method_exists($this, 'message'))
            ? $this->container->call([$this, 'message'])
            : 'The given data was invalid.';

        throw new HttpResponseException(response()->json(
            [
                'status_code'  => HttpResponse::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $message,
                'errors'  => $validator->errors(),
            ],
            HttpResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
