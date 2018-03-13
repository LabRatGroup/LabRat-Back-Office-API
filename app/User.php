<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int    $id
 * @property mixed  $name
 * @property mixed  $email
 * @property mixed  $password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string token
 */
class User extends Authenticatable
{
    use Notifiable;

    const ITEM_TOKEN_LENGTH = 25;

    protected $table = 'users';

   

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $visible = [
        'name',
        'email',
        'password',
        'token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
}
