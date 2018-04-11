<?php

namespace App\Models;

use Carbon\Carbon;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int    $id
 * @property string token
 * @property mixed  $project
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property mixed  $states
 */
class MlModel extends BaseEntity
{
    use SoftDeletes, CascadeSoftDeletes;

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

    protected $cascadeDeletes = ['states'];

    /**
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return HasMany
     */
    public function states()
    {
        return $this->hasMany(MlModelState::class);
    }

    /**
     * @return HasMany
     */
    public function predictions()
    {
        return $this->hasMany(MlModelPrediction::class);
    }

    /**
     * @param Project $project
     */
    public function setProject(Project $project)
    {
        $this->project()->associate($project)->save();
    }

    /**
     * @return bool|MlModelState
     */
    public function getCurrentState()
    {
        foreach ($this->states as $state) {
            if ($state->is_current) {
                return $state;
            }
        }

        return false;
    }
}
