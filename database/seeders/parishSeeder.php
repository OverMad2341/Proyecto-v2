<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class parishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parish')->insert([
            ['name' => 'Parroquia San Juan', 'municipality_id' => 1],
            ['name' => 'Parroquia El Carmen', 'municipality_id' => 1],
            ['name' => 'Parroquia San Pedro', 'municipality_id' => 2],
            ['name' => 'Parroquia La Vega', 'municipality_id' => 2],
            ['name' => 'Parroquia Santa Rosa', 'municipality_id' => 2],
        ]);
    }
}
