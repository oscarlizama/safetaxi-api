<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Seeder;

class PersonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i = 0; $i < 15; $i++){
            Persona::create([
                'nombre' => $faker->firstName(),
                'apellido' => $faker->lastName(),
                'sexo' => $faker->randomElement($array = array ('F', 'M')) ,
                'fechaNacimiento' => $faker->dateTimeBetween('1950-01-01', '2002-12-31'),
                'user_id' => $faker->unique()->numberBetween(1, \App\Models\User::count()),
            ]);
        }
    }
}
