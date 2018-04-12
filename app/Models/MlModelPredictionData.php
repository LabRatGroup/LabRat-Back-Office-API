<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

/**
 * @property mixed mime_type
 */
class MlModelPredictionData extends Eloquent
{
    use SoftDeletes;
    use HybridRelations;

    protected $connection = 'mongodb';
    protected $collection = 'ml_prediction_data_collections';

    protected $fillable = [
        'algorithm',
        'params',
        'mime_type',
        'data',
        'ml_model_prediction_id',
    ];

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
