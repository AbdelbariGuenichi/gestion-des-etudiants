<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Etudiant;

class EtudiantSeeder extends Seeder
{
    public function run()
    {
        Etudiant::factory()->count(10)->create([
            'CpLieuNaissance' => 5000,
            'CpAdresse' => 5000,
        ]);

    }
}
