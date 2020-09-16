<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Item::class, function (Faker $faker) {
    return [
        'code' => substr($faker->word,1,6),
        'name' => $faker->streetName,
        'ro_level'=> $faker->numberBetween(50,100),
        'isbn' => (string)$faker->numberBetween(9900000000,9990000000),
        'print_date' => '2020-01-01',
        'revised_date' => '2020-01-01',
        'author' => $faker->name,
        'publishers_id' => $faker->numberBetween(1,500),
        'items_types_id' => $faker->numberBetween(1,4),
        'modify_by_id' => 1,
        'users_id' => 1,
        'company_infos_id' => 1,
        'created_at'       => '2019-04-15 19:13:32',
        'updated_at'       => '2019-04-15 19:13:32',
    ];
});
