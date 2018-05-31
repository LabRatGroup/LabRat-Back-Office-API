<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

abstract class ApiController extends Controller
{
    const HTTP_OK_MESSAGE = 'api.client.messages.http_ok';
    const HTTP_CREATED_MESSAGE = 'api.client.messages.http_created';
    const HTTP_PATCHED_MESSAGE = 'api.client.messages.http_patched';
    const HTTP_DESTROYED_MESSAGE = 'api.client.messages.http_destroyed';
    const HTTP_NOT_FOUND_MESSAGE = 'api.client.messages.http_not_found';
    const HTTP_INTERNAL_SERVER_ERROR_MESSAGE = 'api.client.messages.http_internal_server_error';
    const HTTP_UNPROCESSABLE_ENTITY_MESSAGE = 'api.client.messages.http_unprocessable_entity';
    const HTTP_FORBIDDEN = 'api.client.messages.http_forbidden';
    const HTTP_DESTROY_ERROR = 'api.client.message.http_destroy_error';
    const HTTP_UNAUTHORIZED = "api.client.message.http_unauthorized";

    /**
     * @var string
     */
    protected $data;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var int
     */
    protected $statusCode;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param $data
     * @param $message
     *
     * @return JsonResponse
     */
    public function responseOk($data, $message = null)
    {
        return $this->setStatusCode(HttpResponse::HTTP_OK)
            ->setData($data)
            ->setMessage($message, trans(self::HTTP_OK_MESSAGE))
            ->response();
    }

    /**
     * @param $data
     * @param $message
     *
     * @return JsonResponse
     */
    public function responseCreated($data, $message = null)
    {
        return $this->setStatusCode(HttpResponse::HTTP_CREATED)
            ->setData($data)
            ->setMessage($message, trans(self::HTTP_CREATED_MESSAGE))
            ->response();
    }

    /**
     * @param $data
     * @param $message
     *
     * @return JsonResponse
     */
    public function responseUpdated($data, $message = null)
    {
        return $this->setStatusCode(HttpResponse::HTTP_OK)
            ->setData($data)
            ->setMessage($message, trans(self::HTTP_PATCHED_MESSAGE))
            ->response();
    }

    /**
     * @param null $data
     * @param      $message
     *
     * @return JsonResponse
     */
    public function responseDeleted($data = null, $message = null)
    {
        return $this->setStatusCode(HttpResponse::HTTP_OK)
            ->setData($data)
            ->setMessage($message, trans(self::HTTP_DESTROYED_MESSAGE))
            ->response();
    }

    /**
     * @param $message
     *
     * @return JsonResponse
     */
    public function responseNotFound($message = null)
    {
        return $this->setStatusCode(HttpResponse::HTTP_NOT_FOUND)
            ->setMessage($message, trans(self::HTTP_NOT_FOUND_MESSAGE))
            ->responseWithError();
    }

    /**
     * @param $message
     *
     * @return JsonResponse
     */
    public function responseInternalError($message = null)
    {
        return $this->setStatusCode(HttpResponse::HTTP_INTERNAL_SERVER_ERROR)
            ->setMessage($message, trans(self::HTTP_INTERNAL_SERVER_ERROR_MESSAGE))
            ->responseWithError();
    }

    /**
     * @param $message
     *
     * @return JsonResponse
     */
    public function responseValidationError($message = null)
    {
        return $this->setStatusCode(HttpResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->setMessage($message, trans(self::HTTP_UNPROCESSABLE_ENTITY_MESSAGE))
            ->responseWithError();
    }

    /**
     * @param $message
     *
     * @return JsonResponse
     */
    public function responseAccessDenied($message = null)
    {
        return $this->setStatusCode(HttpResponse::HTTP_UNAUTHORIZED)
            ->setMessage($message, trans(self::HTTP_UNAUTHORIZED))
            ->responseWithError();
    }

    /**
     * @param $message
     *
     * @return JsonResponse
     */
    public function responseForbidden($message = null)
    {
        return $this->setStatusCode(HttpResponse::HTTP_FORBIDDEN)
            ->setMessage($message, trans(self::HTTP_FORBIDDEN))
            ->responseWithError();
    }

    /**
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function responseWithError(array $headers = [])
    {
        return Response::json([
            'message'     => $this->getMessage(),
            'status_code' => $this->getStatusCode(),
        ], $this->getStatusCode(), $headers);
    }

    /**
     * @param array $headers
     *
     * @return JsonResponse
     * @internal param array $data
     */
    private function response(array $headers = [])
    {
        return Response::json([
            'data'        => $this->getData(),
            'message'     => $this->getMessage(),
            'status_code' => $this->getStatusCode(),
        ], $this->getStatusCode(), $headers);
    }

    /**
     * @param $data
     *
     * @return ApiController
     */
    private function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return int
     */
    private function getData()
    {
        return $this->data;
    }

    /**
     * @param $message
     * @param $default
     *
     * @return ApiController
     */
    private function setMessage($message, $default)
    {
        $this->message = $message ? $message : $default;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $statusCode
     *
     * @return ApiController
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
