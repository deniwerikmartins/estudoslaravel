<?php

use Faker\Generator as Faker;

$factory->define(App\Contato::class, function (Faker $faker) {
    return [
    	//'id' => $faker->randomNumber,
        'nome' => $faker->name
        /*'organizacao' => $faker->company,
        'telefone' => $faker->randomNumber,
        'email' => $faker->email,
        'grupo' => $faker->company,
        'endereco' => $faker->streetName,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'user_id' => $faker->randomNumber*/
    ];
});
