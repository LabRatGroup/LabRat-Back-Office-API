<?php

use App\Models\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title'           => $faker->sentence(rand(2, 3)),
        'description'     => $faker->sentence(20),
    ];
});
