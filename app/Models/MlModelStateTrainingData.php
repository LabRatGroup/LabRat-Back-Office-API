<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

/**
 * @property string trainData
 * @property string id
 */
class MlModelStateTrainingData extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'ml_training_data_collections';
}
