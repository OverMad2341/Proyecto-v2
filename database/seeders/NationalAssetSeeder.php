<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class NationalAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('national_asset')->insert([
            [
                'asset_code' => 'BN-001',
                'description' => 'Computadora de escritorio HP EliteDesk 800 G5',
                'brand' => 'HP',
                'model' => 'EliteDesk 800 G5',
                'serial_number' => 'SN123456789',
                'purchase_date' => '2023-05-20',
                'purchase_value' => 850.00,
                'status' => 'available',
                'vin' => '1HGCM82633A123456',
                'plate_number' => 'AA123AA',
                'material' => 'Plástico y metal',
                'id_category' => 1, // Hardware
                'id_location' => 1, // Ubicación existente
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_code' => 'BN-002',
                'description' => 'Laptop Dell Latitude 5520',
                'brand' => 'Dell',
                'model' => 'Latitude 5520',
                'serial_number' => 'SN987654321',
                'purchase_date' => '2022-11-10',
                'purchase_value' => 1200.00,
                'status' => 'in_use',
                'vin' => '2HGFA16528H123457',
                'plate_number' => 'BB234BB',
                'material' => 'Aluminio',
                'id_category' => 1,
                'id_location' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_code' => 'BN-003',
                'description' => 'Impresora Epson EcoTank L3250',
                'brand' => 'Epson',
                'model' => 'EcoTank L3250',
                'serial_number' => 'SN2468101214',
                'purchase_date' => '2024-01-15',
                'purchase_value' => 350.00,
                'status' => 'available',
                'vin' => '3CZRE48579G654321',
                'plate_number' => 'CC345CC',
                'material' => 'Plástico',
                'id_category' => 3, // Periféricos
                'id_location' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_code' => 'BN-004',
                'description' => 'Vehículo Toyota Hilux 4x4',
                'brand' => 'Toyota',
                'model' => 'Hilux 2021',
                'serial_number' => 'SN1112131415',
                'purchase_date' => '2021-09-30',
                'purchase_value' => 25000.00,
                'status' => 'in_service',
                'vin' => 'JT123YU90K1234567',
                'plate_number' => 'DD456DD',
                'material' => 'Metal',
                'id_category' => 4, // Transporte o similar
                'id_location' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'asset_code' => 'BN-005',
                'description' => 'Router Cisco Catalyst 9200',
                'brand' => 'Cisco',
                'model' => 'Catalyst 9200',
                'serial_number' => 'SN1617181920',
                'purchase_date' => '2023-03-01',
                'purchase_value' => 1500.00,
                'status' => 'available',
                'vin' => '1N4AL11D75C123890',
                'plate_number' => 'EE567EE',
                'material' => 'Metal y plástico',
                'id_category' => 4, // Redes
                'id_location' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
