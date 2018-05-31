<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;

/**
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int    $id
 */
class Role extends BaseEntity
{
    const STANDARD_USER_ROLE = 'system-user';
    const APP_INI_USER_ROLE = 'super-admin';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'alias',
        'permissions',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }
}
