<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\User;
use Faker\Provider\sv_SE\Municipality;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Empleado::factory(10)->create();
        
        $this->call([
        UsersSeeder::class,
        CategoriasSeeder::class,
        GerenciasSeeder::class,
        SubcategoriaSeeder::class,
        SubsubcategoriaSeeder::class,
        
    ]);
    }
}
