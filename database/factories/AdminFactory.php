<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admin::class, function (Faker $faker) {
    return [
        'name' => 'Administrator WS',
        'email' => 'admin@ws.com',
        'password' => bcrypt('admin'),
        'remember_token' => str_random(10)
    ];
});
