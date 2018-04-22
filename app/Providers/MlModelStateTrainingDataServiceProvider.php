<?php

namespace App\Providers;

use App\Models\MlModelStateTrainingData;
use Illuminate\Support\ServiceProvider;

class MlModelStateTrainingDataServiceProvider extends ServiceProvider
{
    public function boot()
    {
        MlModelStateTrainingData::creating(function (MlModelStateTrainingData $trainingData) {
            $trainingData->token = str_random(MlModelStateTrainingData::ITEM_TOKEN_LENGTH);
        });
    }
}
