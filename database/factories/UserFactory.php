<?php

use App\User;
use App\Role;
use App\Post;
use App\Category;
use App\Subcategory;
use App\HeadImage;
use App\SocialLink;
use App\SocialLinkType;

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'picture' => 'https://cataas.com/cat',
        'country' => $faker->country,
        'about' => $faker->paragraph,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function(Faker $faker) {
    $title = $faker->words(2, true);
    return [
        'head_image_id' => function() { return factory(HeadImage::class)->create()->id; },
        'title' => $title,
        'subtitle' => $faker->sentence,
        'content' => $faker->paragraph,
        'slug' => str_replace([' ', 'å', 'ä', 'ö', 'Å', 'Ä', 'Ö'], ['-', 'a', 'a', 'o', 'A', 'A', 'O'], strtolower($title)),
        'hidden' => $faker->boolean,
        'published' => $faker->dateTime,
    ];
});

$factory->define(App\Category::class, function(Faker $faker) {
    $name = $faker->word;
    return [
        'slug' => str_replace([' ', 'å', 'ä', 'ö', 'Å', 'Ä', 'Ö'], ['-', 'a', 'a', 'o', 'A', 'A', 'O'], strtolower($name)),
        'name' => $faker->word,
    ];
});

$factory->define(App\Subcategory::class, function(Faker $faker) {
    $name = $faker->word;
    return [
        'slug' => str_replace([' ', 'å', 'ä', 'ö', 'Å', 'Ä', 'Ö'], ['-', 'a', 'a', 'o', 'A', 'A', 'O'], strtolower($name)),
        'name' => $faker->word,
        'category_id' => function(){return factory(Category::class)->create()->id;},
    ];
});

$factory->define(App\HeadImage::class, function(Faker $faker) {
    return [
        'thumbnail' => 'https://cataas.com/cat',
        'desktop' => 'https://cataas.com/cat',
        'tablet' => 'https://cataas.com/cat',
        'phone' => 'https://cataas.com/cat',
    ];
});

$factory->define(App\SocialLink::class, function(Faker $faker) {
    return [
        'url' => $faker->url,
    ];
});
