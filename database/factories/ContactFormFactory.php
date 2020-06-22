<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ContactForm; //変更
use Faker\Generator as Faker;

$factory->define(ContactForm::class, function (Faker $faker) {
    return [ //Model→ContactForm変更

        //$faker->作りたいダミー条件,
        'your_name' => $faker->name,
        'title' => $faker->realText(50),
        'email' => $faker->unique()->email,
        'url' => $faker->url,
        'gender' => $faker->randomElement(['0', '1']),
        'age' => $faker->numberBetween($min = 1, $max = 6),
        'contact' => $faker->realText(200),
        //連想配列　必須はrequired
    ];
});
