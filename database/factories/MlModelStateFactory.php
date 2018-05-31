<?php

use App\Models\MlModelState;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(MlModelState::class, function (Faker $faker) {

    $params = json_encode([[
        $faker->word => $faker->word,
        $faker->word => $faker->word,
        $faker->word => $faker->word,
    ]]);

    return [
        'ml_model_id'     => null,
        'ml_algorithm_id' => null,
        'params'          => $params,
        'is_current'      => true,
        'mime_type' => $faker->mimeType,
        'file_path' => $faker->word,
    ];
});
