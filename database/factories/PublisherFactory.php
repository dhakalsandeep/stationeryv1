<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Publisher::class, function (Faker $faker) {
    return [
        'name' => $faker->word.' Publishing House',
        'country'=> $faker->countryCode,
        'address' => $faker->streetAddress,
        'url' => $faker->url,
        'modify_by_id' => 1,
        'user_id' => 1,
        'company_infos_id' => 1,
        'created_at'       => '2019-04-15 19:13:32',
        'updated_at'       => '2019-04-15 19:13:32',
    ];
});
