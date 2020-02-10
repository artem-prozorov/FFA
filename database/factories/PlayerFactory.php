<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\{Game, Player, User};
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

$factory->define(Player::class, function (Faker $faker) {
    return [
        'status' => 1,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'game_id' => function () {
            return factory(Game::class)->create()->id;
        },
    ];
});
