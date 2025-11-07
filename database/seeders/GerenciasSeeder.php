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
            ['name' => 'Gerencia de Comunicaciones y Relaciones Internas'],
            ['name' => 'Gerencia de Presupuesto'],
            ['name' => 'Gerencia de Proyecto'],
            ['name' => 'Gerencia de Atención al Cuidadano'],
            ['name' => 'Gerencia de Consultoria Juridica'],
            ['name' => 'Gerencia de Modelado de Procesos'],
            ['name' => 'Presidencia'],
        ]);
    }
}
