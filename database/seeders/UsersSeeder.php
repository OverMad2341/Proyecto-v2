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
                'cedula' => 31288143,
                'name' => 'Andres',
                'name_02' => 'Eduardo',
                'surname_01' => 'Cuicas',
                'surname_02' => 'Duran',
                'birth_date' => '2005-08-08',
                'birth_place' => 'Caracas',
                'sex' => 'M',
                'nationality' => 'Venezolana',
                'email' => 'admin23@cnti.gob.ve',
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
