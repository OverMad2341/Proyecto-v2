<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GerenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gerencias')->insert([
            ['name' => 'Gerencia de Tecnología y Operaciones'],
            ['name' => 'Gerencia de Administracion'],
            ['name' => 'Gerencia de Recursos Humanos'],
            ['name' => 'Gerencia de Formación'],
            ['name' => 'Gerencia de Finanzas'],
            ['name' => 'Gerencia de Atención al Estado'],
            ['name' => 'Gerencia de Proyectos'],
            ['name' => 'Gerencia de Asuntos Jurídicos'],
            ['name' => 'Gerencia de Comunicaciones y Relaciones Internas'],
            ['name' => 'Presidencia'],
        ]);
    }
}
