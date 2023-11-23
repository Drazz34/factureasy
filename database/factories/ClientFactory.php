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
            "nom" => ucwords($this->faker->words(1, true)),
            "prenom" => ucwords($this->faker->words(1, true)),
            "email" => $this->faker->unique()->safeEmail,
            "raison_sociale" => ucwords($this->faker->words(2, true)),
            "telephone" => $this->faker->regexify('[0-9]{10}'),
            "facture_envoyee" => $this->faker->boolean,
            "facture_payee" => $this->faker->boolean,
        ];
    }
}
