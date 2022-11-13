<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "nombre"     => $this->faker->name(),
            "nfecha"   => $this->faker->date(),
            "sexo"     => $this->faker->randomElement(['M', 'F']),
            "estatura" => $this->faker->numberBetween(100, 200),
            "peso"     => $this->faker->randomNumber(2),

        ];
    }
}
