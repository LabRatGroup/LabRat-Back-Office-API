<?php

namespace App\Providers;

use App\Models\MlModel;
use Illuminate\Support\ServiceProvider;

class MlModelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        MlModel::creating(function (MlModel $model) {
            $model->token = str_random(MlModel::ITEM_TOKEN_LENGTH);
        });
    }
}
