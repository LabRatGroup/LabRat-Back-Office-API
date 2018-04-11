<?php

namespace App\Repositories;

use App\Models\MlModelPrediction;

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
}
