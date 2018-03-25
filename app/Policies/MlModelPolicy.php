<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MlModelPolicy
{
    use HandlesAuthorization;

    /**
     * @return mixed
     */
    public function create()
    {
        return auth()->check();
    }
}
