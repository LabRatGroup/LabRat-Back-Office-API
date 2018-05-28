<?php

namespace App\Repositories;

use App\Models\MlModel;
use Illuminate\Support\Facades\Auth;

class MlModelRepository extends BaseRepository
{
    /**
     * MlModelRepository constructor.
     *
     * @param MlModel $model
     */
    public function __construct(MlModel $model)
    {
        $this->model = $model;
    }

    public function findAllByUserOrTeamMember()
    {
        $userId = Auth::id();
        $userTeams = array_column(auth()->user()->teams->toArray(), 'id');

        return $this->getModel()->newQuery()
            ->whereHas('project.users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->orWhereHas('project.teams', function ($query) use ($userTeams) {
                $query->whereIn('teams.id', $userTeams);
            })
            ->get();
    }
}
