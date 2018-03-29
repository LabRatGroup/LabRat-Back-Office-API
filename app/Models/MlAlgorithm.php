<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property mixed  $params
 * @property mixed  $states
 * @property Carbon $updated_at
 * @property Carbon $created_at
 */
class MlAlgorithm extends BaseEntity
{
    protected $fillable = [
        'name',
        'description',
        'alias',
    ];

    /**
     * @return HasMany
     */
    public function params()
    {
        return $this->hasMany(MlAlgorithmParam::class);
    }

    /**
     * @return HasMany
     */
    public function states(){
        return $this->hasMany(MlModelState::class);
    }
}
