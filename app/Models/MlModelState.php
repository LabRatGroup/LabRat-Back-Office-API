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
 * @property mixed   $score
 * @property mixed   $model
 * @property string  token
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 * @property mixed   params
 * @property boolean is_current
 * @property mixed   file_extension
 * @property mixed   ml_model_state_training_data_id
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
        'file_extension',
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
     * @return BelongsTo
     */
    public function trainingData()
    {
        return $this->belongsTo(MlModelStateTrainingData::class);
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

    private function setIsCurrent($value)
    {
        $this->is_current = $value;
        $this->save();
    }

    /**
     * @param MlModelStateTrainingData $modelStateTrainingData
     */
    public function setTrainingData(MlModelStateTrainingData $modelStateTrainingData)
    {
        $this->ml_model_state_training_data_id = $modelStateTrainingData->getQueueableId();
    }
}
