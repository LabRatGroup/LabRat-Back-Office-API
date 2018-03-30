<?php

namespace App\Repositories;

use App\Models\MlModelStateScore;

class MlModelStateScoreRepository extends BaseRepository
{
    /**
     * MlModelRepository constructor.
     *
     * @param MlModelStateScore $model
     */
    public function __construct(MlModelStateScore $model)
    {
        $this->model = $model;
    }
}
