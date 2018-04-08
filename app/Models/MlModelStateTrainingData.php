<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

/**
 * @property string trainData
 * @property string id
 * @property mixed  mime_type
 * @property mixed  data
 */
class MlModelStateTrainingData extends Eloquent
{
    use HybridRelations;

    protected $connection = 'mongodb';
    protected $collection = 'ml_training_data_collections';

    protected $fillable = [
        'algorithm',
        'params',
        'mime_type',
        'data',
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
}