<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int    $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property mixed  $algorithm
 * @property mixed  $score
 * @property mixed  $model
 */
class MlModelState extends BaseEntity
{
    use SoftDeletes;

    const ITEM_TOKEN_LENGTH = 25;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'is_current',
        'params',
    ];

    protected $hidden = [
        'token',
    ];

    /**
     * @return BelongsTo
     */
    public function model()
    {
        return $this->belongsTo(MlModel::class);
    }

    /**
     * @return BelongsTo
     */
    public function algorithm()
    {
        return $this->belongsTo(MlAlgorithm::class);
    }

    /**
     * @return HasOne
     */
    public function score()
    {
        return $this->hasOne(MlModelStateScore::class);
    }
}
