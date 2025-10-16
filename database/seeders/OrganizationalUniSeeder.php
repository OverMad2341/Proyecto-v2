<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrganizationalUniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organizational_uni')->insert([
            [
                'gerency' => 'Gerencia de Tecnología',
                'departament' => 'Departamento de Sistemas',
                'lider' => 'Carlos Mendoza',
                'address' => 'Edificio Central, piso 2, oficina 205',
                'location_id' => 1,
            ],
            [
                'gerency' => 'Gerencia de Recursos Humanos',
                'departament' => 'Departamento de Capacitación',
                'lider' => 'María González',
                'address' => 'Torre Sur, piso 3, oficina 302',
                'location_id' => 2,
            ],
            [
                'gerency' => 'Gerencia de Operaciones',
                'departament' => 'Departamento de Logística',
                'lider' => 'José Ramírez',
                'address' => 'Sede Industrial, galpón 1',
                'location_id' => 3,
            ],
            [
                'gerency' => 'Gerencia de Finanzas',
                'departament' => 'Departamento de Contabilidad',
                'lider' => 'Laura Pérez',
                'address' => 'Edificio Administrativo, piso 1',
                'location_id' => 4,
            ],
            [
                'gerency' => 'Gerencia de Planificación',
                'departament' => 'Departamento de Proyectos',
                'lider' => 'Andrés Silva',
                'address' => 'Anexo Norte, oficina 12',
                'location_id' => 5,
            ],
        ]);
    }
}
