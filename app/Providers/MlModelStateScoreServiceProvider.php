<?php

namespace App\Providers;

use App\Models\MlModelStateScore;
use Illuminate\Support\ServiceProvider;

class MlModelStateScoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        MlModelStateScore::creating(function (MlModelStateScore $score) {
            $score->token = str_random(MlModelStateScore::ITEM_TOKEN_LENGTH);
        });
    }
}
