<?php

use App\Models\MlModelPredictionData;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(MlModelPredictionData::class, function (Faker $faker) {
    return [
        'mime_type' => $faker->mimeType,
        'data'      => $faker->words(10),
        'algorithm' => null,
        'params'    => null,
    ];
});
