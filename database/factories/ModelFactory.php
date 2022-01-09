<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Admin::class, function (Faker $faker) {
    static $password;

    return [
        'user_name' => $faker->name,
        'email' => $faker->email,
        'role_id' => 1,
        'real_name' => 'andy',
        'mobile' => '13333333333',
        'tel' => '755-3333444',
        'valid_time' => '155555555',
        'valid_time_format' => '2018-12-21 5:2:2',
        'last_time' => '2018-12-21 5:2:2',
        'last_ip' => '0.0.0.0',
        'access_token' => '1231',
        'auth_key' => '53423',
        'auth_codes' => '1231',
        'ec_salt' => '1513123',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10)
    ];
});
