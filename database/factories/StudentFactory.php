<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'ci' =>rand(1111111,9999999),
        'complement' =>$faker->randomElement([null,null,'1A','3B','OC','IX']),
        'full_name' =>$faker->name,
        //'first_name' =>$faker->name,
        //'second_name' =>$faker->name,
        //'lastname' =>$faker->lastname,
        //'second_lastname' => $faker->lastname,
        'birth_date' => $faker->dateTimeBetween('1990-01-01', '2012-12-31'),
        'scholarship' => $faker->randomElement(['Juegos Deportivos','Olimpiadas Cientificas','Convocatoria','Discapacidad','Institutos'])
    ];
});
