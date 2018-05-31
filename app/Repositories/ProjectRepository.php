<?php

namespace App\Repositories;

use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Auth;

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

    public function findAllByUserOrTeamMember()
    {
        $userId = Auth::id();
        $userTeams = array_column(auth()->user()->teams->toArray(), 'id');

        return $this->getModel()->newQuery()
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->orWhereHas('teams', function ($query) use ($userTeams) {
                $query->whereIn('teams.id', $userTeams);
            })
            ->get();
    }

    /**
     * @param Project $project
     *
     * @return bool|null
     * @throws Exception
     */
    public function remove(Project $project)
    {
        $project->users()->detach();

        return $project->delete();
    }
}
