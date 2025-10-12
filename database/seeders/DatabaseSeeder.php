<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Mara',
            'name_02' => 'Alexandra',
            'surname_01' => 'Herrera',
            'surname_02' => 'Conquista',
            'cedula' => '12345678',
            'birth_date' => '1990-01-01',
            'birth_place' => 'Caracas',
            'sex' => 'M',
            'nationality' => 'Venezolana',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), 
        ]);
    }
}
