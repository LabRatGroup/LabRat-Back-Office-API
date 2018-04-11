<?php

namespace App\Repositories;

use App\Models\MlModelPredictionData;

class MlModelPredictionDataRepository extends BaseRepository
{
    /**
     * MlModelRepository constructor.
     *
     * @param MlModelPredictionData $model
     */
    public function __construct(MlModelPredictionData $model)
    {
        $this->model = $model;
    }
}
