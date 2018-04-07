<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(\App\Models\MlModelStateTrainingData::class, function (Faker $faker) {
    return [
        'file_name'      => $faker->word(),
        'file_extension' => $faker->word(),
        'ml_model_state_id' => null,
        'data'           => $faker->words(10),
    ];
});
