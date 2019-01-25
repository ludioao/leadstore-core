<?php

use Faker\Generator as Faker;

$factory->define(LeadStore\Framework\Models\Database\Category::class, function (Faker $faker) {
    $name = $faker->text(5);
    return [
        'name' => $name,
        'slug' => str_slug($name),
    ];
});
