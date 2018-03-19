<?php

namespace App\Policies;

use App\Models\Team;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use \Exception;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Team $team
     *
     * @return bool
     */
    public function view(User $user, Team $team)
    {
        return $team->isMember($user);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return auth()->check();
    }

    /**
     * @param  User $user
     * @param  Team $team
     *
     * @return mixed
     */
    public function update(User $user, Team $team)
    {
        return $team->isOwner($user);
    }

    /**
     * @param  User $user
     * @param  Team $team
     *
     * @return mixed
     */
    public function delete(User $user, Team $team)
    {
        return $team->isOwner($user);
    }

    /**
     * @param User $user
     * @param Team $team
     *
     * @return bool
     * @throws Exception
     */
    public function addUser(User $user, Team $team)
    {
        return $team->isOwner($user);
    }
}