<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class MlModelPredictionScore extends Eloquent
{
    use SoftDeletes;
    use HybridRelations;

    protected $connection = 'mongodb';
    protected $collection = 'ml_training_score_collections';

    protected $fillable = [
        'data',
        'ml_mode_prediction_id',
        'ml_model_state_id',
    ];

    /**
     * @return BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(MlModelState::class);
    }

    public function setState($state)
    {
        $this->state()->associate($state)->save();
    }

    /**
     * @return BelongsTo
     */
    public function prediction()
    {
        return $this->belongsTo(MlModelPrediction::class);
    }

    public function setPrediction($prediction)
    {
        $this->prediction()->associate($prediction)->save();
    }
}
