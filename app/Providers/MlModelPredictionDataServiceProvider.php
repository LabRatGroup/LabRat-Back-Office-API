<?php

namespace App\Providers;

use App\Models\MlModelPredictionData;
use Illuminate\Support\ServiceProvider;

class MlModelPredictionDataServiceProvider extends ServiceProvider
{
    public function boot()
    {
        MlModelPredictionData::creating(function (MlModelPredictionData $predictionData) {
            $predictionData->token = str_random(MlModelPredictionData::ITEM_TOKEN_LENGTH);
        });
    }
}
