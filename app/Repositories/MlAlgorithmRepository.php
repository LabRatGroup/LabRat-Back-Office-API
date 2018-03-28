<?php

namespace App\Repositories;

use App\Models\MlAlgorithm;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MlAlgorithmRepository extends BaseRepository
{
    /**
     * MlModelRepository constructor.
     *
     * @param MlAlgorithm $model
     */
    public function __construct(MlAlgorithm $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function findAll()
    {
        return $this->getModel()
            ->newQuery()
            ->get();
    }

    /**
     * @param $id
     *
     * @return Model
     */
    public function findOneOrFailById($id)
    {
        return $this->getModel()
            ->newQuery()
            ->with('params')
            ->where('id', $id)
            ->firstOrFail();
    }
}
