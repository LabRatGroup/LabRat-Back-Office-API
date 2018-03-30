<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int    $id
 * @property mixed  $state
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property mixed  kappa
 * @property string token
 * @property int    ml_model_state_id
 */
class MlModelStateScore extends Model
{
    use SoftDeletes;

    const ITEM_TOKEN_LENGTH = 25;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'params',
        'kappa',
        'accuracy',
        'tp',
        'tn',
        'fp',
        'fn',
        'sensitivity',
        'specificity',
        'precision',
        'recall',
        'auc',
    ];

    protected $hidden = [
        'token',
    ];

    /**
     * @return BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(MlModelState::class, 'ml_model_state_id');
    }

    public function setState($state)
    {
        $this->state()->associate($state)->save();
    }
}
