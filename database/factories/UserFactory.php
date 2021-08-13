<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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

$index = 0;
$factory->define(User::class, function (Faker $faker) use ($index) {
    return [
        'name' => $faker->name,
        'phone_number' => $faker->phoneNumber,
        'password' => Hash::make('paswordku1234'), // password
        'remember_token' => Str::random(10),
        'created_at' => $faker->dateTimeThisYear()
    ];
});
