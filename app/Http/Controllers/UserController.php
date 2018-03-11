<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserRequest;
use App\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends ApiController
{
    public function index(UserRequest $request)
    {
        return Response::json($request);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->responseAccessDenied('invalid_credentials');
            }
        } catch (JWTException $e) {

            return $this->responseInternalError('could_not_create_token');
        }

        return $this->responseOk(['token' => $token]);
    }

    public function register(UserRequest $request)
    {
        try {
            User::create([
                'name'     => $request->get('name'),
                'email'    => $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]);

            $user = User::first();
            $token = JWTAuth::fromUser($user);

            return $this->responseOk($token);
        } catch (Exception $e) {

            return $this->responseInternalError('could_not_create_user');
        }

    }
}
