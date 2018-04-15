<?php

use App\Models\MlModelPredictionData;
use App\Models\MlModelPredictionScore;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(MlModelPredictionScore::class, function (Faker $faker) {
    $data = json_encode([
        $faker->word => $faker->word,
        $faker->word => $faker->word,
        $faker->word => $faker->word,
    ]);

    return [
        'ml_mode_prediction_id' => null,
        'data'                  => $data,
    ];
});
