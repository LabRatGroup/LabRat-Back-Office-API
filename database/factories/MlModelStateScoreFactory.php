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
        'kappa'             => $faker->randomFloat(5, 1, 100),
        'accuracy'          => $faker->randomFloat(5, 1, 100),
        'tp'                => $faker->randomNumber(2),
        'tn'                => $faker->randomNumber(2),
        'fp'                => $faker->randomNumber(2),
        'fn'                => $faker->randomNumber(2),
        'sensitivity'       => $faker->randomFloat(5, 1, 100),
        'specificity'       => $faker->randomFloat(5, 1, 100),
        'precision'         => $faker->randomFloat(5, 1, 100),
        'recall'            => $faker->randomFloat(5, 1, 100),
        'auc'               => $faker->randomFloat(5, 1, 100),
    ];
});
