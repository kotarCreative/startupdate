<?php

use Illuminate\Support\Str;

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'subdivision_id' => rand(1, 13),
        'first_name' => $first_name = $faker->firstName,
        'last_name' => $last_name = $faker->lastName,
        'slug' => Str::slug(strtolower($first_name) . '-' . strtolower($last_name)),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'email_token' => base64_encode($faker->unique()->safeEmail)
    ];
});

$factory->define(App\Models\Companies\Company::class, function (Faker\Generator $faker) {
    return [
        'subdivision_id' => rand(1, 13),
        'company_progress_type_id' => rand(1, 6),
        'vertical_id' => rand(1, 35),
        'name' => $name = $faker->company,
        'slug' => Str::slug(strtolower($name)),
        'url' => $faker->url,
        'email' => $faker->unique()->safeEmail,
        'description' => $faker->paragraph(3),
        'from_startup_school' => rand(0, 1)
    ];
});

$factory->define(App\Models\Companies\Progress\Update::class, function (Faker\Generator $faker) {
    return [
        'progress_metric_id' => rand(1, 4),
        'value' => $value = rand(0, 10000),
        'growth' => $value > 0 ? rand(0, 100) : 0,
        'other_metric' => $faker->word,
        'description' => $faker->paragraph(2)
   ];
});
