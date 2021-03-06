<?php

use App\Models\MlModel;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(MlModel::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence(rand(2, 3)),
        'description' => $faker->sentence(10),
        'positive'    => $faker->word,
        'project_id'  => null,
    ];
});
