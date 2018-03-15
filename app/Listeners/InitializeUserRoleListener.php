<?php

namespace App\Listeners;

use App\Events\RegisterUserEvent;
use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class InitializeUserRoleListener
{
    /** @var UserRepository */
    private $userRepository;

    /** @var RoleRepository */
    private $roleRepository;

    /**
     * Create the event listener.
     *
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Handle the event.
     *
     * @param RegisterUserEvent $event
     *
     * @return void
     */
    public function handle(RegisterUserEvent $event)
    {

        if ($this->userRepository->count() == 0) {
            $role = $this->roleRepository->findOneRoleOrFailByAlias(Role::APP_INI_USER_ROLE);
        } else {
            $role = $this->roleRepository->findOneRoleOrFailByAlias(Role::STANDARD_USER_ROLE);
        }

        $event->getUser()->roles()->attach($role);
    }
}
