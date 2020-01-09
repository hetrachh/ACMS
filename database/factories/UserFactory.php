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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\UserMaster::class, function (Faker $faker) {

    return [
        'emp_code' => $faker->unique()->numberBetween(1, 20),
        'emp_name' => $faker->name,
        'emp_phno' => $faker->phoneNumber,
        'emp_email' => $faker->unique()->safeEmail,
        'emp_designation' => $faker->randomElement(['QA','Frontend','Backend']),
        'emp_password' => $faker->randomElement(['hello1','hello2','hello3']),
        'emp_status' => rand(0, 1),
        'emp_type' => rand(0, 1),
    ];
});

$factory->define(App\AssetMaster::class, function (Faker $faker) {
    
    return [
        'asset_id' => $faker->unique()->numberBetween(1, 10),
        'asset_category' => $faker->randomElement(['Laptop', 'Pheripherals', 'Others']),
        'asset_name' => $faker->name,
        'emp_code' => $faker->unique()->numberBetween(1, 10),
    ];
});
