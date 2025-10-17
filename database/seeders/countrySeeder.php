<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class countrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('country')->insert([
    ['name_es' => 'Venezuela', 'name_en' => 'Venezuela'],
    ['name_es' => 'Colombia', 'name_en' => 'Colombia'],
    ['name_es' => 'Brasil', 'name_en' => 'Brazil'],
    ['name_es' => 'Argentina', 'name_en' => 'Argentina'],
    ['name_es' => 'México', 'name_en' => 'Mexico'],
    ['name_es' => 'Chile', 'name_en' => 'Chile'],
    ['name_es' => 'Perú', 'name_en' => 'Peru'],
    ['name_es' => 'Ecuador', 'name_en' => 'Ecuador'],
    ['name_es' => 'Uruguay', 'name_en' => 'Uruguay'],
    ['name_es' => 'Paraguay', 'name_en' => 'Paraguay'],
    ['name_es' => 'Bolivia', 'name_en' => 'Bolivia'],
    ['name_es' => 'Costa Rica', 'name_en' => 'Costa Rica'],
    ['name_es' => 'Panamá', 'name_en' => 'Panama'],
    ['name_es' => 'Cuba', 'name_en' => 'Cuba'],
    ['name_es' => 'República Dominicana', 'name_en' => 'Dominican Republic'],
    ['name_es' => 'Honduras', 'name_en' => 'Honduras'],
    ['name_es' => 'El Salvador', 'name_en' => 'El Salvador'],
    ['name_es' => 'Guatemala', 'name_en' => 'Guatemala'],
    ['name_es' => 'Nicaragua', 'name_en' => 'Nicaragua'],
    ['name_es' => 'Puerto Rico', 'name_en' => 'Puerto Rico'],
    ['name_es' => 'España', 'name_en' => 'Spain'],
    ['name_es' => 'Portugal', 'name_en' => 'Portugal'],
    ['name_es' => 'Estados Unidos', 'name_en' => 'United States'],
    ['name_es' => 'Canadá', 'name_en' => 'Canada'],
    ['name_es' => 'Reino Unido', 'name_en' => 'United Kingdom'],
    ['name_es' => 'Francia', 'name_en' => 'France'],
    ['name_es' => 'Italia', 'name_en' => 'Italy'],
    ['name_es' => 'Alemania', 'name_en' => 'Germany'],
    ['name_es' => 'Países Bajos', 'name_en' => 'Netherlands'],
    ['name_es' => 'Bélgica', 'name_en' => 'Belgium'],
    ['name_es' => 'Suiza', 'name_en' => 'Switzerland'],
    ['name_es' => 'Suecia', 'name_en' => 'Sweden'],
    ['name_es' => 'Noruega', 'name_en' => 'Norway'],
    ['name_es' => 'Finlandia', 'name_en' => 'Finland'],
    ['name_es' => 'Dinamarca', 'name_en' => 'Denmark'],
    ['name_es' => 'Irlanda', 'name_en' => 'Ireland'],
    ['name_es' => 'Rusia', 'name_en' => 'Russia'],
    ['name_es' => 'China', 'name_en' => 'China'],
    ['name_es' => 'Japón', 'name_en' => 'Japan'],
    ['name_es' => 'Corea del Sur', 'name_en' => 'South Korea'],
    ['name_es' => 'India', 'name_en' => 'India'],
    ['name_es' => 'Australia', 'name_en' => 'Australia'],
    ['name_es' => 'Nueva Zelanda', 'name_en' => 'New Zealand'],
    ['name_es' => 'Sudáfrica', 'name_en' => 'South Africa'],
    ['name_es' => 'Egipto', 'name_en' => 'Egypt'],
    ['name_es' => 'Marruecos', 'name_en' => 'Morocco'],
    ['name_es' => 'Nigeria', 'name_en' => 'Nigeria'],
    ['name_es' => 'Arabia Saudita', 'name_en' => 'Saudi Arabia'],
    ['name_es' => 'Turquía', 'name_en' => 'Turkey'],
    ['name_es' => 'Israel', 'name_en' => 'Israel'],
]);
    }
}
