<?php

namespace App;

use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


/**
 * @property int    $id
 * @property mixed  $name
 * @property mixed  $email
 * @property mixed  $password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string token
 * @property mixed  projects
 * @property mixed  teams
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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
        'id',
        'name',
        'email',
        'token',
        'pivot',
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


    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class)
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class)
            ->withTimestamps();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
