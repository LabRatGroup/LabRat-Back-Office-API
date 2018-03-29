<?php

namespace App\Repositories;

use App\Models\MlModelState;

class MlModelStateRepository extends BaseRepository
{
    /**
     * MlModelRepository constructor.
     *
     * @param MlModelState $model
     */
    public function __construct(MlModelState $model)
    {
        $this->model = $model;
    }
}
