<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use App\Models\Phone;
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

$factory->define(Phone::class, function (Faker $faker) {
    return [
        'phone' => $faker->numberBetween(1000000, 9999999999999999),
    ];

});
