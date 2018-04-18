<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed  mime_type
 * @property mixed  params
 * @property mixed  id
 * @property string token
 */
class MlModelPredictionData extends BaseEntity
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
    public function prediction()
    {
        return $this->belongsTo(MlModelPrediction::class, 'ml_model_prediction_id');
    }

    public function setPrediction($prediction)
    {
        $this->prediction()->associate($prediction)->save();
    }
}
