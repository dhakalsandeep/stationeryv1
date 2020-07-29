<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

//$factory->define(\App\Supplier::class, function (Faker $faker) {
//    return [
//        'name' => $faker->name,
//        'address' => $faker->address,
//        'phoneno' => $faker->phoneNumber,
//        'email' => $faker->email,
//        'users_id' => 1,
//        'company_infos_id' => 1,
//        'created_at'       => '2019-04-15 19:13:32',
//        'updated_at'       => '2019-04-15 19:13:32',
//    ];
//});
