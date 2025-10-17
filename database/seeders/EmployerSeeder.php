<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employee')->insert([
            [
                'position' => 'Analista de Sistemas',
                'is_active' => true,
                'organizational_uni' => 1,
                'users' => 30313815,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'position' => 'Técnico de Soporte',
                'is_active' => true,
                'organizational_uni' => 1,
                'users' => 27654982,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'position' => 'Coordinador de TI',
                'is_active' => true,
                'organizational_uni' => 1,
                'users' => 31845269,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'position' => 'Administrador de Red',
                'is_active' => true,
                'organizational_uni' => 1,
                'users' => 29401654,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'position' => 'Soporte Técnico',
                'is_active' => false,
                'organizational_uni' => 1,
                'users' => 26548397,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
