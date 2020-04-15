<?php



$factory->define(\chirag\Employee\QuickEmployee::class, function (Faker\Generator $faker) {
    return [
        'emp_id' => $faker->randomNumber(6),
        'epm_name' => $faker->name,
        'ip_address' => $faker->ipv4,
    ];
});