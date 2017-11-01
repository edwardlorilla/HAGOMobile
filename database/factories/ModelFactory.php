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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Repository::class, function (Faker\Generator $faker) {

    return [
        'name' => 'Falcatifolium taxoides (Podocarpaceae)',
        'description' => 'Falcatifolium is a genus of conifers belonging to the podocarp family Podocarpaceae. The genus includes evergreen dioecious shrubs and large trees of up to 36 metres. Five species are presently recognized.',
        'scientificName' =>'Podocarpaceae',
        'longitude' => 126.186388888888,
        'latitude' => 6.72333333333333,
    ];
});
