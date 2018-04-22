<?php

use App\Models\MlModelPredictionData;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(MlModelPredictionData::class, function (Faker $faker) {
    $params = json_encode([
        $faker->word => $faker->word,
        $faker->word => $faker->word,
        $faker->word => $faker->word,
    ]);
    return [
        'mime_type' => $faker->mimeType,
        'file_path' => $faker->word,
        'params'    => $params,
    ];
});
