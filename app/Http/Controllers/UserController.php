<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use \Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends ApiController
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Checks user identity based upon email and password and returns an auth token back to the user.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = auth()->attempt($credentials)) {

                return $this->responseAccessDenied('invalid_credentials');
            }

            return $this->responseOk(['token' => $token]);
        } catch (JWTException $e) {

            return $this->responseInternalError('could_not_create_token');
        }
    }

    /**
     * Logs out authenticated user.
     *
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
     * Registers new user and send auth token.
     *
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

    /**
     * Password recovery action.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function recover(Request $request)
    {
        $params = $request->only(['email']);
        $user = $this->userRepository->findOneOrFailByEmail($params['email']);
        if (!$user) {
            return $this->responseAccessDenied('Your email address was not found.');
        }

        try {
            Password::sendResetLink($params, function (Message $message) {
                $message->subject('Your Password Reset Link');
            });

            return $this->responseOk(null, 'A reset email has been sent! Please check your email.');
        } catch (Exception $e) {

            return $this->responseAccessDenied($e->getMessage());
        }
    }

    /**
     * Removes a user from the system.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function unRegister(Request $request)
    {
        $params = $request->only(['email']);
        $user = $this->userRepository->findOneOrFailByEmail($params['email']);

        if (!$user) {
            return $this->responseAccessDenied('Your email address was not found.');
        }

        try {
            $this->userRepository->delete($user);
            auth()->logout();

            return $this->responseOk(null, 'Your account has been removed.');
        } catch (Exception $e) {

            return $this->responseAccessDenied($e->getMessage());
        }
    }
}
