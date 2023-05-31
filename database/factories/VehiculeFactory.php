<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicule>
 */
class VehiculeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricule' => fake()->numberBetween(1000, 100000000),
            'marque' => fake()->randomElement(['Alfa Romeo',
            'Audi',
            'BMW',
            'Chevrolet',
            'Ferrari',
            'Fiat',
            'Ford',
            'GMC',
            'Honda',
            'Hummer',
            'Hyundai',
            'Infiniti',
            'Jaguar',
            'Jeep',
            'Kia',
            'Lamborghini',
            'Land Rover',
            'Maserati',
            'Mercedes-Benz',
            'Mini',
            'Mitsubishi',
            'Nissan',
            'Porsche',
            'Suzuki',
            'Tesla',
            'Toyota',
            'Volkswagen',
            'Volvo']),
            'modele' => fake()->numberBetween(2012, 2023),
            'couleur' => fake()->colorName(),
            'kilometrage' => fake()->numberBetween(1000, 10000),
            'carburant' => fake()->randomElement(['Essence', "Diesel"]),
            'automatique' => fake()->randomElement([0, 1]),
            'prix_location' => fake()->numberBetween(200, 1000),
            'photo' => fake()->imageUrl(),
            'nombre_portes' => fake()->numberBetween(1, 4),
            'nombre_places' => fake()->numberBetween(1, 6),
            'status' => fake()->randomElement(['Disponible', "Loué", "En panne"]),
        ];
    }
}
