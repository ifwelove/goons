<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Program;
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

$factory->define(Program::class, function (Faker $faker) {
    $url = 'http://media.feearadio.net/downloads/program/BH/bh-191108.mp3';
    $result = [
        'categories' => rand(1, 9),
        'title' => Str::random(10),
        'sub_title' => Str::random(100),
        'url' => $url,
        'end_date' => \Carbon\Carbon::now()->addWeek(),
        'start_date' => \Carbon\Carbon::now()->subWeek(),
        'duration' => rand(1500, 2000),
        'anchor' => Str::random(10),
    ];

    return $result;
});
