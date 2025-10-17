<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DepreciationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('depreciation')->insert([
            [
                'initial_value' => 1500.00,
                'current_value' => 1200.00,
                'calculation_date' => Carbon::parse('2024-01-15'),
                'id_bien' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'initial_value' => 2000.00,
                'current_value' => 1800.00,
                'calculation_date' => Carbon::parse('2024-06-10'),
                'id_bien' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'initial_value' => 5000.00,
                'current_value' => 4300.00,
                'calculation_date' => Carbon::parse('2025-01-05'),
                'id_bien' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'initial_value' => 750.00,
                'current_value' => 650.00,
                'calculation_date' => Carbon::parse('2024-03-22'),
                'id_bien' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'initial_value' => 900.00,
                'current_value' => 850.00,
                'calculation_date' => Carbon::parse('2024-09-14'),
                'id_bien' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
