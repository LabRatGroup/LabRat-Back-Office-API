<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends BaseRepository
{

    /**
     * RoleRepository constructor.
     *
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function findOneRoleOrFailByAlias($alias)
    {
        return $this->getModel()->newQuery()
            ->where('alias', $alias)
            ->firstOrFail();
    }
}
