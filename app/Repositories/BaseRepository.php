<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    public function findAll()
    {
        return $this->getModel()
            ->get();
    }

    /**
     * @param $id
     *
     * @return Model|static
     */
    public function findOneOrFailById($id)
    {
        return $this->getModel()
            ->where('id', $id)
            ->firstOrFail();
    }

    /**
     * @param $token
     *
     * @return Model|static
     */
    public function findOneOrFailByToken($token)
    {
        return $this->getModel()
            ->where('token', $token)
            ->firstOrFail();
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->getModel()->create($attributes);
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
