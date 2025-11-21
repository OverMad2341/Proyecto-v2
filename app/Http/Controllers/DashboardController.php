<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // --- 1. Estadísticas Generales (Stats) ---
        $totalActivos = Activo::count();
        $enUso = Activo::whereNotNull('empleado')->count();
        $enAlmacen = Activo::whereNull('empleado')->count();

        // --- 2. Configuración de Fechas (Últimos 12 meses) ---
        $endDate = Carbon::now()->endOfMonth();
        $startDate = Carbon::now()->subMonths(11)->startOfMonth(); 

        // --- 3. Consultas Optimizadas para SQLite ---
        
        // ACTIVOS CREADOS
        // Usamos strftime('%Y') para el año y strftime('%m') para el mes
        $creados = Activo::whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw("strftime('%Y', created_at) as year"),
                DB::raw("strftime('%m', created_at) as month"),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // ACTIVOS EDITADOS
        // Condición: Se considera editado si 'updated_at' es mayor a 'created_at' por al menos 1 minuto.
        // Sintaxis SQLite: datetime(columna, '+1 minute')
        $editados = Activo::whereBetween('updated_at', [$startDate, $endDate])
            ->whereRaw("updated_at > datetime(created_at, '+1 minute')")
            ->select(
                DB::raw("strftime('%Y', updated_at) as year"),
                DB::raw("strftime('%m', updated_at) as month"),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // --- 4. Unificar Datos para el Gráfico (Relleno de ceros) ---
        $chartData = [];
        $period = Carbon::parse($startDate)->toPeriod($endDate, '1 month');

        // Indexamos los resultados por "AAAA-MM" para búsqueda rápida
        $creadosLookup = $creados->keyBy(fn($item) => sprintf("%d-%02d", $item->year, $item->month));
        $editadosLookup = $editados->keyBy(fn($item) => sprintf("%d-%02d", $item->year, $item->month));

        foreach ($period as $date) {
            // Generamos la clave "AAAA-MM" del mes actual del bucle
            $key = $date->format('Y-m'); 
            
            $chartData[] = [
                'fecha'   => $date->format('Y-m-01'), 
                // Buscamos en los resultados o ponemos 0 si no hay datos
                'creados' => $creadosLookup->get($key)->count ?? 0,
                'editados'=> $editadosLookup->get($key)->count ?? 0,
            ];
        }

        return Inertia::render('Dashboard', [
            'stats' => [
                'total' => $totalActivos,
                'enUso' => $enUso,
                'enAlmacen' => $enAlmacen,
            ],
            'chartData' => $chartData,
        ]);
    }
}