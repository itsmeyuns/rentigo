<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'sexe' => fake()->randomElement(['M','F']),
            'date_naissance' => fake()->date(),
            'lieu_naissance' => fake()->address(),
            'adresse' => fake()->address(),
            'cin' => fake()->regexify('[A-Za-z0-9]{1,15}'),
            'telephone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'numero_permis' => fake()->regexify('[A-Za-z0-9]{1,20}'),
            'observation' => fake()->text(50)
        ];
    }
}
