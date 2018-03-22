<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'title'           => $faker->sentence(rand(2, 3)),
        'description'     => $faker->sentence(20),
        'token'      => str_random(Project::ITEM_TOKEN_LENGTH),
        'created_at'      => $faker->date(),
        'updated_at'      => $faker->date(),
    ];
});
