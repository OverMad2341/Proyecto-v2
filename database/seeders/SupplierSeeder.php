<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('supplier')->insert([
            [
                'name' => 'Tecnología Global C.A.',
                'address' => 'Av. Principal de Los Ruices, Edif. GlobalTech, Caracas.',
                'email' => 'contacto@globaltech.com',
                'telephone' => '+58 212-5551111',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Distribuidora Digital Plus',
                'address' => 'Zona Industrial La Yaguara, Galpón 12, Caracas.',
                'email' => 'ventas@digitalplus.com',
                'telephone' => '+58 414-2223344',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'OfiMarket Venezuela',
                'address' => 'Av. Libertador, Centro Empresarial Libertador, Valencia.',
                'email' => 'soporte@ofimarket.com',
                'telephone' => '+58 241-5557788',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RedNet Solutions C.A.',
                'address' => 'Calle 8 con Av. 3A, Maracaibo, Edo. Zulia.',
                'email' => 'info@rednetsolutions.com',
                'telephone' => '+58 261-4435566',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Consumibles Express',
                'address' => 'C.C. Los Próceres, Local 24, Barinas.',
                'email' => 'pedidos@consumiblesexpress.com',
                'telephone' => '+58 273-3322211',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
