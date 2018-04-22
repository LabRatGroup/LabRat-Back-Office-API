<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property string trainData
 * @property string id
 * @property mixed  mime_type
 * @property mixed  data
 * @property string token
 * @property mixed  file_path
 */
class MlModelStateTrainingData extends BaseEntity
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
        'mime_type',
        'file_path',
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
