<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Api\V1\Models\Post::class, function (Faker $faker) {
    return [
        'id' => Ulid::generate(),
        'title' => $faker->name,
        'short_description' => $faker->text(300),
        'description' => $faker->text(1000),
    ];
});
