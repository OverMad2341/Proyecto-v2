<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //esta en funcionamiento
        DB::table('users')->insert([
            [
                'cedula' => 30313815,
                'name' => 'Isaac',
                'name_02' => 'Josue',
                'surname_01' => 'Silva',
                'surname_02' => 'Zurita',
                'birth_date' => '1995-04-10',
                'birth_place' => 'Caracas',
                'sex' => 'M',
                'nationality' => 'Venezolana',
                'email' => 'isaac1@gmail.com',
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cedula' => 27654982,
                'name' => 'María',
                'name_02' => null,
                'surname_01' => 'Fernández',
                'surname_02' => null,
                'birth_date' => '1992-07-21',
                'birth_place' => 'Maracay',
                'sex' => 'F',
                'nationality' => 'Venezolana',
                'email' => 'maria.fernandez@example.com',
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cedula' => 31845269,
                'name' => 'Carlos',
                'name_02' => null,
                'surname_01' => 'Mendoza',
                'surname_02' => null,
                'birth_date' => '1988-12-05',
                'birth_place' => 'Valencia',
                'sex' => 'M',
                'nationality' => 'Venezolana',
                'email' => 'carlos.mendoza@example.com',
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cedula' => 29401654,
                'name' => 'Ana',
                'name_02' => null,
                'surname_01' => 'Torres',
                'surname_02' => null,
                'birth_date' => '1996-03-19',
                'birth_place' => 'Barquisimeto',
                'sex' => 'F',
                'nationality' => 'Venezolana',
                'email' => 'ana.torres@example.com',
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cedula' => 26548397,
                'name' => 'Luis',
                'name_02' => null,
                'surname_01' => 'Martínez',
                'surname_02' => null,
                'birth_date' => '1990-09-12',
                'birth_place' => 'Mérida',
                'sex' => 'M',
                'nationality' => 'Venezolana',
                'email' => 'luis.martinez@example.com',
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
