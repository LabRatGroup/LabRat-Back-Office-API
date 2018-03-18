<?php

namespace App\Repositories;

use App\Models\Team;

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
}
