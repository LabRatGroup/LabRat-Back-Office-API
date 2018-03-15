<?php

namespace App\Repositories;

use App\User;

class UserRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function findOneOrFailByEmail($email)
    {
        return $this->getModel()
            ->where('email', '=', $email)
            ->first();
    }
}
