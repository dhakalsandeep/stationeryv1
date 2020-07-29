<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'phoneno' => (string)$faker->numberBetween(9842000000,9899000000),
        'email' => $faker->email,
        'users_id' => 1,
        'company_infos_id' => 1,
        'created_at'       => '2019-04-15 19:13:32',
        'updated_at'       => '2019-04-15 19:13:32',
    ];
});
