<?php

namespace App\Policies;

use App\Models\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * @return bool
     */
    public function list()
    {
        return auth()->check();
    }

    /**
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function view(User $user, Project $project)
    {
        return $project->isMember($user);
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
     * @param Project $project
     * @return mixed
     */
    public function update(User $user, Project $project)
    {
        return $project->isOwner($user);
    }

    /**
     * @param User $user
     * @param Project $project
     * @param      $userId
     *
     * @return bool
     */
    public function deleteMember(User $user, Project $project, $userId)
    {
        if ($project->isOwner($user)) {
            if ($user->id == $userId) {
                return sizeOf($project->owners()) > 1;
            }
        } else {
            return $user->id == $userId;
        }

        return true;
    }

    /**
     * @param  User $user
     * @param Project $project
     * @return mixed
     */
    public function delete(User $user, Project $project)
    {
        return $project->isOwner($user);
    }

    /**
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function addUser(User $user, Project $project)
    {
        return $project->isOwner($user);
    }
}
