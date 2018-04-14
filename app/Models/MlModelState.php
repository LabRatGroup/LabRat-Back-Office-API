<?php

namespace App\Models;

use Carbon\Carbon;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

/**
 * @property int     $id
 * @property mixed   $algorithm
 * @property MlModelStateScore   $score
 * @property mixed   $model
 * @property string  token
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 * @property mixed   params
 * @property boolean is_current
 * @property mixed   file_extension
 * @property mixed   trainingData
 */
class MlModelState extends BaseEntity
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
        'is_current',
        'params',
    ];

    protected $hidden = [
        'token',
    ];

    protected $cascadeDeletes = ['score'];

    /**
     * @return BelongsTo
     */
    public function model()
    {
        return $this->belongsTo(MlModel::class, 'ml_model_id');
    }

    /**
     * @return BelongsTo
     */
    public function algorithm()
    {
        return $this->belongsTo(MlAlgorithm::class, 'ml_algorithm_id');
    }

    /**
     * @return HasOne
     */
    public function score()
    {
        return $this->hasOne(MlModelStateScore::class);
    }

    /**
     * @return HasOne
     */
    public function trainingData()
    {
        return $this->hasOne(MlModelStateTrainingData::class);
    }

    /**
     * @param MlModel $model
     */
    public function setModel(MlModel $model)
    {
        $this->model()->associate($model)->save();
    }

    /**
     * @param MlAlgorithm $algorithm
     */
    public function setAlgorithm(MlAlgorithm $algorithm)
    {
        $this->algorithm()->associate($algorithm)->save();
    }

    public function setAsCurrent()
    {
        /** @var MlModelState $state */
        foreach ($this->model->states as $state) {
            if ($this->id == $state->id) {
                $state->setIsCurrent(true);
            } else {
                $state->setIsCurrent(false);
            }
        }
    }

    public function setIsCurrent($value)
    {
        $this->is_current = $value;
        $this->save();
    }
}
