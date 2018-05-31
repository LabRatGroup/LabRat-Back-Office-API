<?php

namespace App\Repositories;

use App\Models\MlModelPredictionScore;

class MlModelPredictionScoreRepository extends BaseRepository
{
    /**
     * MlModelRepository constructor.
     *
     * @param MlModelPredictionScore $model
     */
    public function __construct(MlModelPredictionScore $model)
    {
        $this->model = $model;
    }
}
