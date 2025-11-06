<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubsubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subsubcategorias = [
            // Estaciones de trabajo
            ['name' => 'Computadora de escritorio', 'subcategoria_name' => 'Estaciones de trabajo'],
            ['name' => 'Laptop', 'subcategoria_name' => 'Estaciones de trabajo'],
            ['name' => 'Tablet', 'subcategoria_name' => 'Estaciones de trabajo'],
            ['name' => 'regulador', 'subcategoria_name' => 'Estaciones de trabajo'],
            ['name' => 'regleta', 'subcategoria_name' => 'Estaciones de trabajo'],
            ['name' => 'UPS', 'subcategoria_name' => 'Estaciones de trabajo'],
            ['name' => 'Televisores', 'subcategoria_name' => 'Estaciones de trabajo'],

            // Servidores
            ['name' => 'Rack', 'subcategoria_name' => 'Servidores'],
            ['name' => 'Torre', 'subcategoria_name' => 'Servidores'],
            ['name' => 'Blade', 'subcategoria_name' => 'Servidores'],

            // Periféricos
            ['name' => 'Impresoras', 'subcategoria_name' => 'Periféricos'],
            ['name' => 'Escáneres', 'subcategoria_name' => 'Periféricos'],
            ['name' => 'Monitores', 'subcategoria_name' => 'Periféricos'],
            ['name' => 'Teclados', 'subcategoria_name' => 'Periféricos'],
            ['name' => 'Ratones', 'subcategoria_name' => 'Periféricos'],
            ['name' => 'Camaras', 'subcategoria_name' => 'Periféricos'],
            ['name' => 'Audifonos', 'subcategoria_name' => 'Periféricos'],
            ['name' => 'Otros periféricos', 'subcategoria_name' => 'Periféricos'],

            // Componentes
            ['name' => 'Discos duros', 'subcategoria_name' => 'Componentes'],
            ['name' => 'Memorias RAM', 'subcategoria_name' => 'Componentes'],
            ['name' => 'Tarjetas gráficas', 'subcategoria_name' => 'Componentes'],
            ['name' => 'Procesadores', 'subcategoria_name' => 'Componentes'],
            ['name' => 'Placas base', 'subcategoria_name' => 'Componentes'],
            ['name' => 'Otros componentes', 'subcategoria_name' => 'Componentes'],

            // Vehículos de transporte
            ['name' => 'Camionetas', 'subcategoria_name' => 'vehiculos de trasporte'],
            ['name' => 'Buses', 'subcategoria_name' => 'vehiculos de trasporte'],
            ['name' => 'Motocicletas', 'subcategoria_name' => 'vehiculos de trasporte'],
            ['name' => 'Automóviles', 'subcategoria_name' => 'vehiculos de trasporte'],

            // Vehículos de carga
            ['name' => 'Camiones', 'subcategoria_name' => 'vehiculos de carga'],
            ['name' => 'Furgonetas', 'subcategoria_name' => 'vehiculos de carga'],

            // Equipos de redes
            ['name' => 'Switches', 'subcategoria_name' => 'Equipos de redes'],
            ['name' => 'Routers', 'subcategoria_name' => 'Equipos de redes'],
            ['name' => 'Hubs', 'subcategoria_name' => 'Equipos de redes'],
            ['name' => 'Bridge', 'subcategoria_name' => 'Equipos de redes'],
            ['name' => 'Modems', 'subcategoria_name' => 'Equipos de redes'],
            ['name' => 'Otros equipos de redes', 'subcategoria_name' => 'Equipos de redes'],

            // Accesorios de redes
            ['name' => 'Cables', 'subcategoria_name' => 'Accesorios de redes'],
            ['name' => 'Conectores', 'subcategoria_name' => 'Accesorios de redes'],
            ['name' => 'Patch panels', 'subcategoria_name' => 'Accesorios de redes'],

            // Dispositivos de telecomunicaciones
            ['name' => 'Teléfonos IP', 'subcategoria_name' => 'Dispositivos de telecomunicaciones'],
            ['name' => 'Antenas', 'subcategoria_name' => 'Dispositivos de telecomunicaciones'],

            // Muebles de oficina
            ['name' => 'Sillas', 'subcategoria_name' => 'Muebles de oficina'],
            ['name' => 'Escritorios', 'subcategoria_name' => 'Muebles de oficina'],
            ['name' => 'Archivadores', 'subcategoria_name' => 'Muebles de oficina'],
            ['name' => 'Estanterías', 'subcategoria_name' => 'Muebles de oficina'],
            ['name' => 'Sofás', 'subcategoria_name' => 'Muebles de oficina'],
            ['name' => 'Mesas de reuniones', 'subcategoria_name' => 'Muebles de oficina'],
            ['name' => 'pizarras', 'subcategoria_name' => 'Muebles de oficina'],

            // Equipos de oficina
            ['name' => 'Fotocopiadoras', 'subcategoria_name' => 'Equipos de oficina'],
            ['name' => 'Proyectores', 'subcategoria_name' => 'Equipos de oficina'],

            // Otros enseres
            ['name' => 'Lámparas', 'subcategoria_name' => 'Otros enseres'],
            ['name' => 'Relojes', 'subcategoria_name' => 'Otros enseres'],
            ['name' => 'Decoraciones', 'subcategoria_name' => 'Otros enseres'],

            // Herramientas manuales
            ['name' => 'Destornilladores', 'subcategoria_name' => 'Herramientas manuales'],
            ['name' => 'Llaves', 'subcategoria_name' => 'Herramientas manuales'],
            ['name' => 'Martillos', 'subcategoria_name' => 'Herramientas manuales'],

            // Herramientas eléctricas
            ['name' => 'Taladros', 'subcategoria_name' => 'Herramientas eléctricas'],
            ['name' => 'Sierras', 'subcategoria_name' => 'Herramientas eléctricas'],
            ['name' => 'Lijadoras', 'subcategoria_name' => 'Herramientas eléctricas'],
            ['name' => 'tester', 'subcategoria_name' => 'Herramientas eléctricas'],


            // Equipos especializados
            ['name' => 'Medidores', 'subcategoria_name' => 'Equipos especializados'],
            ['name' => 'Osciloscopios', 'subcategoria_name' => 'Equipos especializados'],
            ['name' => 'Generadores de señal', 'subcategoria_name' => 'Equipos especializados'],

            // Otros equipos
            ['name' => 'Compresores', 'subcategoria_name' => 'Otros equipos'],

        ];

        foreach ($subsubcategorias as $subcat) {
            $categoria = DB::table('subcategorias')->where('name', $subcat['subcategoria_name'])->first();
            if ($categoria) {
                DB::table('subsubcategorias')->insert([
                    'name' => $subcat['name'],
                    'subcategoria_id' => $categoria->id,
                ]);
            }
        }
    }
}