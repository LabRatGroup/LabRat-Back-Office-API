<?php

use App\Models\MlModelPredictionData;
use App\Models\MlModelPredictionScore;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(MlModelPredictionScore::class, function (Faker $faker) {

    return [
        'ml_model_prediction_data_id' => null,
        'prediction'                  => $faker->word,
        'sample'                      => $faker->word,
    ];
});
