<?php

namespace Database\Seeders;
use App\Models\Conductor;
use Illuminate\Database\Seeder;

class ConductorTableSeeder extends Seeder
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
            Conductor::create([
                'licenciaConducir' => $faker->regexify('^\d{4}-\d{6}-\d{3}-\d{1}$'),
                'dui' => $faker->regexify('^\d{8}-\d{1}$'),
                'estadoContratado' => $faker->boolean(),
                'fechaContratacion' => $faker->dateTimeBetween('2015-01-01', '2019-12-31')
            ]);
        }
    }
}
