<?php

use App\User;
use App\Role;
use App\Post;
use App\Category;
use App\Subcategory;

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
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function(Faker $faker) {
    $title = $faker->words(2, true);
    return [
        'title' => $title,
        'subtitle' => $faker->sentence,
        'content' => $faker->paragraph,
        'slug' => $slug = str_replace([' ', 'å', 'ä', 'ö', 'Å', 'Ä', 'Ö'], ['-', 'a', 'a', 'o', 'A', 'A', 'O'], strtolower($title)),
        'hidden' => $faker->boolean,
        'published' => $faker->boolean,
    ];
});

$factory->define(App\Category::class, function(Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Subcategory::class, function(Faker $faker) {
    return [
        'name' => $faker->word,
        'category_id' => function(){return factory(Category::class)->create()->id;},
    ];
});
