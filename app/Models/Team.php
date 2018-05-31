<?php

namespace App\Models;

use App\Models\Traits\Collaboration;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string token
 * @property int    $id
 */
class Team extends BaseEntity
{
    use Collaboration;

    const ITEM_TOKEN_LENGTH = 25;

    const TEAM_OWNER_ROLE_ALIAS = 'project-admin';
    const TEAM_MANAGER_ROLE_ALIAS = 'project-manager';
    const TEAM_USER_ROLE_ALIAS = 'project-user';
    const TEAM_DEFAULT_ROLE_ALIAS = 'project-user';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'token',
    ];

    protected $visible = [
        'id',
        'name',
        'token',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('is_owner', 'user_id', 'team_id', 'is_owner', 'role_id')
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
}
