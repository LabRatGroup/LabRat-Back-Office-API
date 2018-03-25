<?php

namespace App\Repositories;

use App\Models\MlModel;

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
}
