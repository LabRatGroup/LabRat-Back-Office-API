<?php

namespace App\Providers;

use App\Models\MlModelState;
use Illuminate\Support\ServiceProvider;

class MlModelStateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        MlModelState::creating(function (MlModelState $state) {
            $state->token = str_random(MlModelState::ITEM_TOKEN_LENGTH);
        });
    }
}
