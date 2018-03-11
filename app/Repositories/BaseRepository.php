<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes)
    {
        $entity = $this->getModel();
        $entity->fill($attributes);
        $entity->save();

        return $entity;
    }

    /**
     * @param Model $entity
     * @param array $attributes
     *
     * @return Model
     */
    public function update(Model $entity, array $attributes)
    {
        $entity->fill($attributes);
        $entity->save();

        return $entity;
    }

    /**
     * @param Model $entity
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Model $entity)
    {
        return $entity->delete();
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }
}
