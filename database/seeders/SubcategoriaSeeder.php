<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategorias = [
            // Equipos de cómputo
            ['name' => 'Estaciones de trabajo', 'categoria_name' => 'Equipos de cómputo'],
            ['name' => 'Servidores', 'categoria_name' => 'Equipos de cómputo'],
            ['name' => 'Periféricos', 'categoria_name' => 'Equipos de cómputo'],
            ['name' => 'Componentes', 'categoria_name' => 'Equipos de cómputo'],
            ['name' => 'Otros', 'categoria_name' => 'Equipos de cómputo'],

            // Vehículos
            ['name' => 'vehiculos de trasporte', 'categoria_name' => 'Vehículos'],
            ['name' => 'vehiculos de carga', 'categoria_name' => 'Vehículos'],

            // Infraestructura de Redes
            ['name' => 'Equipos de redes', 'categoria_name' => 'Infraestructura de Redes'],
            ['name' => 'Accesorios de redes', 'categoria_name' => 'Infraestructura de Redes'],
            ['name' => 'Dispositivos de telecomunicaciones', 'categoria_name' => 'Infraestructura de Redes'],

            // Mobiliario y Enseres
            ['name' => 'Muebles de oficina', 'categoria_name' => 'Mobiliario y Enseres'],
            ['name' => 'Equipos de oficina', 'categoria_name' => 'Mobiliario y Enseres'],
            ['name' => 'Otros enseres', 'categoria_name' => 'Mobiliario y Enseres'],

            // Herramientas y Equipos
            ['name' => 'Herramientas manuales', 'categoria_name' => 'Herramientas y Equipos'],
            ['name' => 'Herramientas eléctricas', 'categoria_name' => 'Herramientas y Equipos'],
            ['name' => 'Equipos especializados', 'categoria_name' => 'Herramientas y Equipos'],
            ['name' => 'Otros equipos', 'categoria_name' => 'Herramientas y Equipos'],

        ];

        foreach ($subcategorias as $subcat) {
            $categoria = DB::table('categorias')->where('name', $subcat['categoria_name'])->first();
            if ($categoria) {
                DB::table('subcategorias')->insert([
                    'name' => $subcat['name'],
                    'categoria_id' => $categoria->id,
                ]);
            }
        }
    }
}
