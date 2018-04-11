<?php

namespace App\Repositories;

use App\Models\MlModelStateTrainingData;

class MlModelStateTrainingDataRepository extends BaseRepository
{
    /**
     * MlModelRepository constructor.
     *
     * @param MlModelStateTrainingData $model
     */
    public function __construct(MlModelStateTrainingData $model)
    {
        $this->model = $model;
    }
}
