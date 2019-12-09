<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Push;
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

$factory->define(Push::class, function (Faker $faker) {

    $result = [
        'type' => 1,//0未推播, 1已推播
        'status' => 1,//0預約發送, 1立即發送
        'start_date' => \Carbon\Carbon::now(),
        'end_date' => \Carbon\Carbon::now()->addYear(),
        'title' => Str::random(20),
        'sub_title' => Str::random(100),
        'receiveNoti' => 0,
        'url' => '{"firstClase":"D","secClase":"B","lastClase":"2"}',
    ];

    return $result;
});
