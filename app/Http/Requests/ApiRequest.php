<?php

namespace App\Http\Requests;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

trait ApiRequest
{
    public function response(array $errors)
    {
        if (in_array('api', $this->route()->getAction()['middleware'])) {
            return Response::json([
                'message'     => trans(ApiController::HTTP_UNPROCESSABLE_ENTITY_MESSAGE),
                'status_code' => HttpResponse::HTTP_UNPROCESSABLE_ENTITY,
                'errors'      => $errors,
            ], HttpResponse::HTTP_UNPROCESSABLE_ENTITY);

        } else {
            parent::response($errors);
        }
    }

    protected function failedValidation(Validator $validator)
    {
        $message = (method_exists($this, 'message'))
            ? $this->container->call([$this, 'message'])
            : 'The given data was invalid.';

        throw new HttpResponseException(response()->json(
            [
                'status'  => HttpResponse::HTTP_UNPROCESSABLE_ENTITY,
                'errors'  => $validator->errors(),
                'message' => $message,
            ],
            HttpResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
