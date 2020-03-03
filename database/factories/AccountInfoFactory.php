<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AccountInfo;
use Faker\Generator as Faker;

$factory->define(AccountInfo::class, function (Faker $faker) {
    return [
        'account' => $faker->unique()->userName,
        'name' => $faker->name,
        'gender' => rand(0, 1),
        'birth' => $faker->date('Y-m-d', 'now'),
        'email' => $faker->unique()->safeEmail,
        'message' => $faker->text(20),
        'created_at' => time(),
        'updated_at' => time(),
    ];
});
