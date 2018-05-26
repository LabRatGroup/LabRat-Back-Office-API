<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Team;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $currentUser)
    {
        return $user->token == $currentUser->token;
    }

    public function delete(User $user)
    {
        $projectFlag = true;
        $teamFlag = true;

        foreach ($user->projects as $project) {
            /** @var Project $project */
            if (sizeOf($project->owners()) <= 1) {
                $projectFlag = false;
                break;
            }
        }

        foreach ($user->teams as $team) {
            /** @var Team $team */
            if (sizeOf($team->owners()) <= 1) {
                $teamFlag = false;
                break;
            }
        }

        return $projectFlag && $teamFlag;
    }
}
