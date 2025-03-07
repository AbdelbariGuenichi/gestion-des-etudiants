<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ville>
 */
class VilleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
            'cpVilles' => $this->faker->unique()->numberBetween(1000, 9999),
            'DesignationVilles' => $this->faker->streetAddress(),

        ];
    }
}
