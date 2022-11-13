<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $faker->name();
        $faker->date();
        $faker->randomNumber(2);
        $faker->numberBetween(100, 200);
        $faker->randomElement(['M', 'F']);

    }
}
