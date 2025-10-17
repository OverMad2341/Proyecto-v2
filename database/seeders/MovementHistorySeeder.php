<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class MovementHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movement_history')->insert([
            [
                'id_bien' => 1,
                'id_organizational_uni' => 1,
                'id_made_by' => 1,
                'movement_date' => Carbon::parse('2025-01-10 08:00:00'),
                'reason' => 'Traslado a oficina principal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_bien' => 2,
                'id_organizational_uni' => 1,
                'id_made_by' => 2,
                'movement_date' => Carbon::parse('2025-02-15 09:30:00'),
                'reason' => 'Asignación temporal a departamento de TI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_bien' => 3,
                'id_organizational_uni' => 1,
                'id_made_by' => 3,
                'movement_date' => Carbon::parse('2025-03-20 11:00:00'),
                'reason' => 'Reparación y mantenimiento',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_bien' => 1,
                'id_organizational_uni' => 1,
                'id_made_by' => 1,
                'movement_date' => Carbon::parse('2025-04-05 14:00:00'),
                'reason' => 'Reubicación a nuevo despacho',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_bien' => 2,
                'id_organizational_uni' => 1,
                'id_made_by' => 2,
                'movement_date' => Carbon::parse('2025-05-12 10:00:00'),
                'reason' => 'Asignación definitiva al departamento financiero',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
