<?php

namespace App\Models;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Relations\HasMany;

/**
 * @property MlModel model
 *
 * @property string  token
 * @property mixed   predictionData
 * @property mixed   id
 * @property mixed   title
 * @property mixed   score
 * @property string  code
 * @property mixed   file_path
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
        'params',
        'mime_type',
        'file_path'
    ];

    protected $hidden = [
        'token',
    ];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|HasMany
     */
    public function score()
    {
        return $this->hasMany(MlModelPredictionScore::class, 'ml_model_prediction_data_id');
    }

    public function setStatus($code)
    {
        $this->code = $code;
        $this->save();
    }
}
