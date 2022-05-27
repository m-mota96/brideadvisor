<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invitation;
use Faker\Generator as Faker;

$factory->define(Invitation::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'status' => 0,
        'table_id' => 1,
        'group_id' => 1,

    ];
});
