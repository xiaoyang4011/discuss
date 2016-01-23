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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'avatar' => $faker->imageUrl(256, 256),
        'password' => bcrypt(str_random(10)),
        'confirm_code' => str_random(48),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Discussion::class, function (Faker\Generator $faker) {
    $user_ids = \App\User::lists('id')->toArray();

    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => $faker->randomElement($user_ids),
        'last_user_id' => $faker->randomElement($user_ids),
    ];
});

$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    $user_ids = \App\User::lists('id')->toArray();
    $discussion_ids = \App\Models\Discussion::lists('id')->toArray();

    return [
        'body' => $faker->paragraph,
        'user_id' => $faker->randomElement($user_ids),
        'discussion_id' => $faker->randomElement($discussion_ids),
    ];
});