<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ville;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a specific ville with postal code 5000 first
        Ville::create([
            'cpVilles' => '5000',
            'DesignationVilles' => 'Ville Principale',
        ]);

        // Create additional random villes
        Ville::factory()->count(9)->create();
    }
}
