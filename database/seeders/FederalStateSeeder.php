<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FederalStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('federal_state')->insert([
            ['name' => 'Amazonas', 'country_id' => 1],
            ['name' => 'Anzoátegui', 'country_id' => 1],
            ['name' => 'Apure', 'country_id' => 1],
            ['name' => 'Aragua', 'country_id' => 1],
            ['name' => 'Barinas', 'country_id' => 1],
            ['name' => 'Bolívar', 'country_id' => 1],
            ['name' => 'Carabobo', 'country_id' => 1],
            ['name' => 'Cojedes', 'country_id' => 1],
            ['name' => 'Delta Amacuro', 'country_id' => 1],
            ['name' => 'Falcón', 'country_id' => 1],
            ['name' => 'Guárico', 'country_id' => 1],
            ['name' => 'Lara', 'country_id' => 1],
            ['name' => 'Mérida', 'country_id' => 1],
            ['name' => 'Miranda', 'country_id' => 1],
            ['name' => 'Monagas', 'country_id' => 1],
            ['name' => 'Nueva Esparta', 'country_id' => 1],
            ['name' => 'Portuguesa', 'country_id' => 1],
            ['name' => 'Sucre', 'country_id' => 1],
            ['name' => 'Táchira', 'country_id' => 1],
            ['name' => 'Trujillo', 'country_id' => 1],
            ['name' => 'Vargas', 'country_id' => 1],
            ['name' => 'Yaracuy', 'country_id' => 1],
            ['name' => 'Zulia', 'country_id' => 1],
            ['name' => 'Distrito Capital', 'country_id' => 1],
        ]);
    }
}
