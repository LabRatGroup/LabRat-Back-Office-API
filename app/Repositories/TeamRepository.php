<?php

namespace App\Repositories;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamRepository extends BaseRepository
{
    /**
     * TeamRepository constructor.
     *
     * @param Team $model
     */
    public function __construct(Team $model)
    {
        $this->model = $model;
    }

    public function findAllByUserMember()
    {
        $userId = Auth::id();

        return $this->getModel()->newQuery()
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->get();
    }

    /**
     * @param Team $team
     *
     * @return bool|null
     * @throws \Exception
     */
    public function remove(Team $team)
    {
        $team->users()->detach();

        return $team->delete();
    }
}
