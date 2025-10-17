<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class NationalAssetAssignamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('national_asset_assignament')->insert([
            [
                'assignment_date' => Carbon::parse('2024-01-15'),
                'observation' => 'Asignado a oficina principal',
                'assignment_status' => 'ASIGNADO',
                'id_bien' => 1,
                'id_employee' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assignment_date' => Carbon::parse('2024-03-22'),
                'observation' => 'Equipo entregado en reparación',
                'assignment_status' => 'EN MANTENIMIENTO',
                'id_bien' => 2,
                'id_employee' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assignment_date' => Carbon::parse('2024-05-10'),
                'observation' => 'Asignado a sucursal este',
                'assignment_status' => 'ASIGNADO',
                'id_bien' => 3,
                'id_employee' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assignment_date' => Carbon::parse('2024-07-01'),
                'observation' => 'Bien devuelto por cambio de puesto',
                'assignment_status' => 'DEVUELTO',
                'id_bien' => 4,
                'id_employee' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'assignment_date' => Carbon::parse('2024-09-14'),
                'observation' => 'Asignado temporalmente a soporte técnico',
                'assignment_status' => 'TEMPORAL',
                'id_bien' => 5,
                'id_employee' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
