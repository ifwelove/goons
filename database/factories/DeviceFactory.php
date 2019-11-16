<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Device;
use Faker\Generator as Faker;
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

$factory->define(Device::class, function (Faker $faker) {
    return [
        'type' => 0,// 1: iOS, 2: Android
        'token' => Str::random(10),
    ];
});
