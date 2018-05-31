<?php

use App\Models\MlModelPrediction;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(MlModelPrediction::class, function (Faker $faker) {
    $params = json_encode([
        $faker->word => $faker->word,
        $faker->word => $faker->word,
        $faker->word => $faker->word,
    ]);

    return [
        'title'           => $faker->sentence(rand(2, 3)),
        'description'     => $faker->sentence(20),
        'mime_type' => $faker->mimeType,
        'file_path' => $faker->word,
        'params'    => $params,
    ];
});
