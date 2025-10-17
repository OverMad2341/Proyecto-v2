<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('team')->insert([
            [
                'name' => 'Equipo de programacion',
                'is_active' => true,
            ],
            [
                'name' => 'soporte tecnico',
                'is_active' => true,
            ],
            [
                'name' => 'Equipo Guerreros',
                'is_active' => false,
            ],
            [
                'name' => 'Equipo de redes',
                'is_active' => true,
            ],
            [
                'name' => 'Equipo Dragones',
                'is_active' => false,
            ],
        ]);
    }
}
