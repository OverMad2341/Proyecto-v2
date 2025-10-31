<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('categorias')->insert([
           ['name' => 'Inmuebles'],
           ['name' => 'Vehículos'],
           ['name' => 'Equipo Informático'],
           ['name' => 'Redes y Telecomunicaciones'],
       ]);
    }
}
