<?php

use App\Models\MlModelStateTrainingData;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(MlModelStateTrainingData::class, function (Faker $faker) {
    return [
        'mime_type' => $faker->mimeType,
        'data'      => $faker->words(10),
        'algorithm' => null,
        'params'    => null,
    ];
});
