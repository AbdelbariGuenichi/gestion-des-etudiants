<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Etudiant;

class EtudiantFactory extends Factory
{
    protected $model = Etudiant::class;

    public function definition()
    {
        return [
            'Nce' => $this->faker->unique()->randomNumber(5, true),
            'nci' => $this->faker->unique()->randomNumber(5, true),
            'Nom' => $this->faker->lastName(),
            'Prenom' => $this->faker->firstName(),
            'DateNaissance' => $this->faker->date('Y-m-d', '-18 years'),
            'CpLieuNaissance' => $this->faker->numberBetween(1000, 9999),
            'Adresse' => $this->faker->streetAddress(),
            'CpAdresse' => $this->faker->numberBetween(1000, 9999),
        ];
    }
}
