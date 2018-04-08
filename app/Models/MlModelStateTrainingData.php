<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

/**
 * @property string trainData
 * @property string id
 */
class MlModelStateTrainingData extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'ml_training_data_collections';

    protected $fillable = [
        'file_name',
        'file_extension',
        'data',
        'ml_model_state_id',
    ];

    /**
     * @return HasMany
     */
    public function states()
    {
        return $this->hasMany(MlModelState::class);
    }
}
