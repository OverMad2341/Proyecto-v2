<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();
        $this->call([
        CountrySeeder::class,
        UsersSeeder::class,
        FederalStateSeeder::class,
        municipalitySeeder::class,
        parishSeeder::class,
        LocationSeeder::class,
        OrganizationalUniSeeder::class,
        TeamSeeder::class,
        PersonSeeder::class,
        EmployerSeeder::class,
        AgentSeeder::class,
    ]);
        // User::factory()->create([
        //     'name' => 'Mara',
        //     'name_02' => 'Alexandra',
        //     'surname_01' => 'Herrera',
        //     'surname_02' => 'Conquista',
        //     'cedula' => '12345678',
        //     'birth_date' => '1990-01-01',
        //     'birth_place' => 'Caracas',
        //     'sex' => 'M',
        //     'nationality' => 'Venezolana',
        //     'email' => 'admin@example.com',
        //     'password' => bcrypt('password'), 
        // ]);
    }
}
