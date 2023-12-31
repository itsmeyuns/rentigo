<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
            'login' => fake()->userName(),
            'role' => fake()->randomElement(['admin', 'agent']),
            'sexe' => fake()->randomElement(['H', 'F']),
            'date_naissance' => fake()->date(),
            'lieu_naissance' => fake()->address(),
            'adresse' => fake()->address(),
            'cin' => Str::random(20),
            'telephone' => fake()->regexify('/^(06|07)\d{8}$/'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('itsmeyuns'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
