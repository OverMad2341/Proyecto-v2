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
                'birth_date' => '1990-04-15',
                'birth_place' => 'Caracas',
                'sex' => 'M',
                'nationality' => 'Venezolano',
                'email' => 'isaac@gmail.com',
                'password' => Hash::make('12345678'),
                'birth_country' => 1,
                'current_team_id' => null,
                'profile_photo_path' => null,
            ],
        ]);
    }
}
