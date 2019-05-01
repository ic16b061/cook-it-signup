<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'givenname' => $faker->givenname,
        'surname' => $faker->surname,
        'email' => $faker->unique()->safeEmail,
        'subdomain' =>  $faker->subdomain,
        'subscription' => $faker->numberBetween($min = 1, $max = 3),
        ];
});
