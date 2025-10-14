<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //no esta en funcionamiento
        DB::table('users')->insert([
            [
                'cedula' => 30313815,
                'name' => 'Isaac',
                'name_02' => 'Josue',
                'surname_01' => 'Silva',
                'surname_02' => 'Zurita',
                'birth_date' => '1998-05-22',
                'birth_place' => 'Caracas',
                'sex' => 'M',
                'nationality' => 'Venezolano',
                'email' => 'isaac@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'), // 🔒 contraseña encriptada
                'birth_country' => 1, // Debe existir un país con id=1 (Venezuela)
                'current_team_id' => null,
                'profile_photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
