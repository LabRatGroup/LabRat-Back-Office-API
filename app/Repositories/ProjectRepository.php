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
}
