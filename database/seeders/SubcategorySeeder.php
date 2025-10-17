<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subcategory')->insert([
            // 🔧 Hardware
            [
                'subcategory_name' => 'Procesadores',
                'description' => 'Unidades de procesamiento central (CPU) de equipos.',
                'category_id' => 1, // Hardware
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'subcategory_name' => 'Memorias RAM',
                'description' => 'Módulos de memoria de acceso aleatorio.',
                'category_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 💻 Software
            [
                'subcategory_name' => 'Sistemas Operativos',
                'description' => 'Software base que controla el hardware del equipo.',
                'category_id' => 2, // Software
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'subcategory_name' => 'Aplicaciones de Oficina',
                'description' => 'Software como procesadores de texto o hojas de cálculo.',
                'category_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 🖨️ Periféricos
            [
                'subcategory_name' => 'Impresoras',
                'description' => 'Equipos periféricos para impresión de documentos.',
                'category_id' => 3, // Periféricos
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'subcategory_name' => 'Teclados y Ratones',
                'description' => 'Dispositivos de entrada para equipos informáticos.',
                'category_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 🌐 Redes
            [
                'subcategory_name' => 'Routers',
                'description' => 'Dispositivos para gestionar la conectividad de red.',
                'category_id' => 4, // Redes
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'subcategory_name' => 'Switches',
                'description' => 'Equipos de red para distribuir conexiones entre dispositivos.',
                'category_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // 🧾 Consumibles
            [
                'subcategory_name' => 'Cartuchos de tinta',
                'description' => 'Insumos de impresión para impresoras de tinta.',
                'category_id' => 5, // Consumibles
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'subcategory_name' => 'Resmas de papel',
                'description' => 'Papel utilizado para impresión y copiado.',
                'category_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
