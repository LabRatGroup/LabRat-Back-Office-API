<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class MlModelPredictionData extends Eloquent
{
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

    public function setPrediction($state)
    {
        $this->prediction()->associate($state)->save();
    }
}
