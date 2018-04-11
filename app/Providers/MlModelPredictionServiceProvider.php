<?php

namespace App\Providers;

use App\Models\MlModelPrediction;
use Illuminate\Support\ServiceProvider;

class MlModelPredictionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        MlModelPrediction::creating(function (MlModelPrediction $state) {
            $state->token = str_random(MlModelPrediction::ITEM_TOKEN_LENGTH);
        });
    }
}
