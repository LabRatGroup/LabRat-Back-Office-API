<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @property int    $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property mixed  $params
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
}
