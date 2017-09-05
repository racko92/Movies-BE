<?php
/**
 * Created by PhpStorm.
 * User: racko92
 * Date: 9/5/17
 * Time: 3:03 PM
 */

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker){
    return [
        'name' => $faker->name,
        'director' => $faker->name,
        'imageUrl' => $faker->imageUrl($width = 640, $height = 480),
        'duration' => $faker->numberBetween(90,180),
        'releaseDate' => $faker->dateTime('2014-02-25 08:37:17'),
        'genres' => $faker->words($nb = 3, $asText = false)
    ];
});