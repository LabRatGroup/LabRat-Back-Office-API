<?php

namespace App\Repositories;

use App\Models\MlModelPrediction;
use Illuminate\Support\Facades\Auth;

class MlModelPredictionRepository extends BaseRepository
{
    /**
     * MlModelRepository constructor.
     *
     * @param MlModelPrediction $model
     */
    public function __construct(MlModelPrediction $model)
    {
        $this->model = $model;
    }

    public function findAllByUserOrTeamMember()
    {
        $userId = Auth::id();
        $userTeams = array_column(auth()->user()->teams->toArray(), 'id');

        return $this->getModel()->newQuery()
            ->whereHas('model.project.users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->orWhereHas('model.project.teams', function ($query) use ($userTeams) {
                $query->whereIn('teams.id', $userTeams);
            })
            ->get();
    }
}
