<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::truncate();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 15; $i++){
            User::create([
                'email' => preg_replace('/@example\..*/', '@gmail.com', $faker->unique()->safeEmail),
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'tipoUsuario' => $faker->randomElement($array = array ('C', 'A', 'O')) ,
            ]);
        }
    }
}
