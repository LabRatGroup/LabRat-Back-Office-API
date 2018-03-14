<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends ApiController
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepositoty
     */
    public function __construct(UserRepository $userRepositoty)
    {
        $this->userRepository = $userRepositoty;
    }

    /**
     * @param UserRequest $request
     *
     * @return mixed
     */
    public function index(UserRequest $request)
    {
        return Response::json($request);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = auth()->attempt($credentials)) {
                return $this->responseAccessDenied('invalid_credentials');
            }
        } catch (JWTException $e) {

            return $this->responseInternalError('could_not_create_token');
        }

        return $this->responseOk(['token' => $token]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth()->logout();

            return $this->responseOk(null, 'You have successfully logged out.');
        } catch (JWTException $e) {

            return $this->responseInternalError('Failed to logout, please try again.');
        }
    }

    /**
     * @param UserRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRequest $request)
    {
        try {
            $this->userRepository->create($request->all());
            $credentials = $request->only('email', 'password');
            if (!$token = auth()->attempt($credentials)) {
                return $this->responseAccessDenied('invalid_credentials');
            }

            return $this->responseOk(['token' => $token]);
        } catch (Exception $e) {

            return $this->responseInternalError('could_not_create_user');
        }
    }
}
