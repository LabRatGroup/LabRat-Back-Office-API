<?php

namespace App\Models;

use App\Models\Traits\Collaboration;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int    $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property mixed  teams
 */
class Project extends Model
{
    use SoftDeletes;
    use Collaboration;

    const ITEM_TOKEN_LENGTH = 25;
    const PROJECT_OWNER_ROLE_ALIAS = 'project-admin';
    const PROJECT_MANAGER_ROLE_ALIAS = 'project-manager';
    const PROJECT_TRANSLATOR_ROLE_ALIAS = 'project-translator';
    const PROJECT_DEFAULT_ROLE_ALIAS = 'project-manager';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'title',
        'description',
    ];
    protected $hidden = [
        'token',
    ];

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('is_owner', 'user_id', 'project_id', 'validation_token', 'is_valid', 'role_id')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class)
            ->withPivot('team_id', 'project_id')
            ->withTimestamps();
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function isMember(User $user)
    {
        $userMembers = [];
        $userMembers = array_merge($userMembers, array_column($this->users->toArray(), 'id'));
        foreach ($this->teams as $team) {
            $userMembers = array_merge($userMembers, array_column($team->users->toArray(), 'id'));
        }

        return array_search($user->id, $userMembers) > -1;
    }
}
