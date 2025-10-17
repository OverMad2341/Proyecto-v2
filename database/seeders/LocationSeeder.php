<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('location')->insert([
            [
                'address' => 'Calle Bolívar, casa N° 12',
                'parish_id' => 1,
            ],
            [
                'address' => 'Avenida Sucre, edificio Los Andes',
                'parish_id' => 1,
            ],
            [
                'address' => 'Sector El Carmen, calle principal',
                'parish_id' => 2,
            ],
            [
                'address' => 'Barrio La Vega, manzana 5',
                'parish_id' => 3,
            ],
            [
                'address' => 'Urbanización Santa Rosa, casa 22',
                'parish_id' => 4,
            ],
        ]);
    }
}
