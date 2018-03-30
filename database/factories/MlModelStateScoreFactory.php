<?php

use App\Models\MlModelStateScore;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(MlModelStateScore::class, function (Faker $faker) {
    $params = json_encode([
        $faker->word => $faker->word,
        $faker->word => $faker->word,
        $faker->word => $faker->word,
    ]);

    return [
        'ml_model_state_id' => null,
        'params'            => $params,
        'kappa'             => $faker->randomFloat(),
        'accuracy'          => $faker->randomFloat(),
        'tp'                => $faker->randomNumber(),
        'tn'                => $faker->randomNumber(),
        'fp'                => $faker->randomNumber(),
        'fn'                => $faker->randomNumber(),
        'sensitivity'       => $faker->randomFloat(),
        'specificity'       => $faker->randomFloat(),
        'precision'         => $faker->randomFloat(),
        'recall'            => $faker->randomFloat(),
        'auc'               => $faker->randomFloat(),
    ];
});
