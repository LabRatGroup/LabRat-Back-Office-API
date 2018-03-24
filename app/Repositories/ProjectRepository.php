<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository extends BaseRepository
{
    /**
     * TeamRepository constructor.
     *
     * @param Project $model
     */
    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    public function findAllByUserOrTeamMember($userId, $userTeams)
    {
        return $this->getModel()->newQuery()
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->orWhereHas('teams', function ($query) use ($userTeams) {
                $query->whereIn('teams.id', $userTeams);
            })
            ->get();
    }
}
