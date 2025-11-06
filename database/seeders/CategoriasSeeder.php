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
           ['name' => 'Equipos de cómputo',
            'description' => 'Estaciones de trabajo, servidores y otros equipos relacionados.'],
           ['name' => 'Vehículos',
            'description' => 'Automóviles, motocicletas y otros medios de transporte.'],
           ['name' => 'Infraestructura de Redes',
            'description' => 'Equipos y dispositivos de redes y telecomunicaciones.'],
            ['name' => 'Mobiliario y Enseres',
            'description' => 'Muebles, equipos de oficina y otros enseres.'],
            ['name' => 'Herramientas y Equipos',
            'description' => 'Herramientas, equipos y accesorios.'],
       ]);
    }
}
