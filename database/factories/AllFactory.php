<?php

use Faker\Generator as Faker;

// User
$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->userName,
        'full_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'token' => str_random(10),
        'remember_token' => str_random(10),
    ];
});


// Social
$factory->define(App\Models\Social::class, function(Faker $faker) {
    $provider = ['facebook', 'twitter', 'gmail'];
    $random = array_rand($provider);

    return [
        'social_id' => $faker->numberBetween(1000, 99999999),
        'provider' => $provider[$random],
        'user_id' => App\Models\User::all()->random()->id
    ];
});

// Products
$factory->define(App\Models\Product::class, function(Faker $faker) {
    $name = $faker->sentence(3);
    
    return [
       'name' => $name,
       'slug' => str_slug($name),
       'tagline' => $faker->sentence(8),
       'subject' => $faker->paragraph(3),
       'thumbnail' => $faker->imageUrl(640, 480),
       'link' => $faker->unique()->url,
       'type_id' => App\Models\Type::all()->random()->id,
       'user_id' => App\Models\User::all()->random()->id
    ];
});

//Product-Comments
$factory->define(App\Models\ProductComment::class, function(Faker $faker) {
    return [
       'subject' => $faker->paragraph(3),
       'product_id' => App\Models\Product::all()->random()->id,
       'user_id' => App\Models\User::all()->random()->id
    ];
});

// Makers
$factory->define(App\Models\Maker::class, function(Faker $faker) {
    return [
       'name' => $faker->name,
       'twitter_username' => $faker->userName,
       'product_id' => App\Models\Product::all()->random()->id
    ];
});

//Product_Tag
$factory->define(App\Models\ProductTag::class, function(Faker $faker) {
    return [
        'tag_id' => App\Models\Tag::all()->random()->id,
        'product_id' => App\Models\Product::all()->random()->id
    ];
});


