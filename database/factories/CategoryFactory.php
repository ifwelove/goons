<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Category;
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

$factory->define(Category::class, function (Faker $faker) {
    $image = 'https://www.google.com.tw/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png';
    $result = [
        'type' => rand(0, 1),
        'title' => Str::random(10),
        'sub_title' => Str::random(100),
        'image' => $image,
        'anchor' => Str::random(10),
    ];

    return $result;
});
