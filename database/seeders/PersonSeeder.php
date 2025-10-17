<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('person')->insert([
            
            [
                'users_permissions' => json_encode(['read' => true, 'write' => true]),
                'is_staff' => true,
                'is_active' => true,
                'last_login' => now(),
                'date_joined' => now(),
                'users' => 30313815,
            ],
            
        ]);
    }
}
