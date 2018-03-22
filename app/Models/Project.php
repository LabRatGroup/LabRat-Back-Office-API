<?php

namespace App\Models;

use App\Models\Traits\Collaboration;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
