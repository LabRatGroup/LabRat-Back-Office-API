<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

/**
 * @property mixed data
 * @property mixed id
 */
class MlModelPredictionScore extends Eloquent
{
    use SoftDeletes;
    use HybridRelations;

    protected $connection = 'mongodb';
    protected $collection = 'ml_model_prediction_score';

    protected $fillable = [
        'prediction',
        'sample',
        'ml_model_prediction_data_id',
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

//    /**
//     * @return BelongsTo
//     */
//    public function prediction()
//    {
//        return $this->belongsTo(MlModelPrediction::class);
//    }

    public function setPrediction($prediction)
    {
        $this->prediction()->associate($prediction)->save();
    }
}
