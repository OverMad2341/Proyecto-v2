<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class municipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipios = [
            ["name" => "Libertador de Caracas", "federal_state_id" => 1],
            ["name" => "Chacao", "federal_state_id" => 1],
            ["name" => "Sucre", "federal_state_id" => 1],
            ["name" => "Baruta", "federal_state_id" => 1],
            ["name" => "El Hatillo", "federal_state_id" => 1],
            
            ["name" => "Anaco", "federal_state_id" => 2],
            ["name" => "Aragua de Barcelona", "federal_state_id" => 2],
            ["name" => "Bolívar", "federal_state_id" => 2],
            ["name" => "Cachipo", "federal_state_id" => 2],
            ["name" => "San José de Guanipa", "federal_state_id" => 2],
        ];

        foreach ($municipios as $municipio) {
            DB::table('municipality')->insert($municipio);
        }
    }
}
