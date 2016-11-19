<?php

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | Here you may define all of your model factories. Model factories give
  | you a convenient way to create models for testing and seeding your
  | database. Just tell the factory how a default model should look.
  |
 */

$factory->define(App\User::class,
        function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ? : $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'facebook_id' => str_random(10),
        'github_id' => str_random(10),
    ];
});

$factory->define(App\ProjectModel::class,
        function (Faker\Generator $faker) {

    return [
        'name' => $faker->sentence(4),
        'description' => $faker->paragraph(5, true),
        'public' => $faker->boolean(),
        'link' => $faker->url,
        'id_user' => $faker->numberBetween(0, 30),
    ];
});


$factory->define(App\ContributionModel::class,
        function (Faker\Generator $faker) {
    return [
    ];
});
