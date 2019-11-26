<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\News;
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

$factory->define(News::class, function (Faker $faker) {
    $autoPush = 0;
    if (rand(0, 1)) {
        $autoPush = 1;
        $result = [
//            'type' => rand(0, 1),
            'auto_push' => $autoPush,
            'title' => Str::random(20),
            'description' => Str::random(100),
        ];
    } else {
        $result = [
//            'type' => rand(0, 1),
            'auto_push' => $autoPush,
            'start_date' => \Carbon\Carbon::now(),
            'end_date' => \Carbon\Carbon::now()->addWeek(),
            'title' => Str::random(20),
            'description' => Str::random(100),
        ];
    }
    return $result;
});
