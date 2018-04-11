<?php

namespace App\Models;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

/**
 * @property MlModel model
 *
 * @property string  token
 * @property mixed   predictionData
 */
class MlModelPrediction extends BaseEntity
{
    use SoftDeletes, CascadeSoftDeletes;
    use HybridRelations;

    const ITEM_TOKEN_LENGTH = 25;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
    ];

    protected $hidden = [
        'token',
    ];

    protected $cascadeDeletes = [];

    /**
     * @return BelongsTo
     */
    public function model()
    {
        return $this->belongsTo(MlModel::class, 'ml_model_id');
    }

    /**
     * @param MlModel $model
     */
    public function setModel(MlModel $model)
    {
        $this->model()->associate($model)->save();
    }

    /**
     * @return HasOne
     */
    public function predictionData()
    {
        return $this->hasOne(MlModelPredictionData::class);
    }
}
