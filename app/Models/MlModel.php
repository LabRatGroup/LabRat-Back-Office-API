<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int    $id
 * @property string token
 * @property mixed  $project
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class MlModel extends BaseEntity
{
    use SoftDeletes;

    const ITEM_TOKEN_LENGTH = 25;

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
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @param Project $project
     */
    public function setProject(Project $project)
    {
        $this->project()->associate($project)->save();
    }
}
