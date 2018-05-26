<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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

    public function update()
    {
        $user = Auth::user();

        return view('user.form')
            ->with('user', $user);
    }

    /**
     * @param ProfileRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function save(ProfileRequest $request)
    {
        $params = $request->only([
            'id',
            'name',
            'email',
            'password'
        ]);

        /** @var User $current */
        $current = $this->userRepository->findOneOrFailById($params['id']);

        $this->authorize('update', $current);

        $params['password'] = $params['password'] ? Hash::make($params['password']) : $current->password;

        $this->userRepository->update($current, $params);

        return view('dashboard');

    }
}
