<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // --- 1. Cálculos de Stats (de la respuesta anterior) ---
        $totalActivos = Activo::count();
        $enUso = Activo::whereNotNull('empleado')->count();
        $enAlmacen = Activo::whereNull('empleado')->count();

        // --- 2. Nuevos Cálculos para el Gráfico (Últimos 12 meses) ---
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subMonths(12)->startOfMonth();

        // Activos Creados por mes (SINTAXIS SQLITE)
        $creados = Activo::whereBetween('created_at', [$startDate, $endDate])
            ->select(
                // Cambiamos YEAR(created_at) por strftime('%Y', created_at)
                DB::raw("strftime('%Y', created_at) as year"), 
                // Cambiamos MONTH(created_at) por strftime('%m', created_at)
                DB::raw("strftime('%m', created_at) as month"), 
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Activos Editados por mes (SINTAXIS SQLITE)
        $editados = Activo::whereBetween('updated_at', [$startDate, $endDate])
            // Cambiamos la sintaxis de INTERVAL por la de datetime() de SQLite
            ->whereRaw("updated_at > datetime(created_at, '+1 minute')") 
            ->select(
                // Hacemos los mismos cambios para updated_at
                DB::raw("strftime('%Y', updated_at) as year"),
                DB::raw("strftime('%m', updated_at) as month"),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // --- 3. Formatear datos para el componente Vue ---
        $chartData = [];
        $period = Carbon::parse($startDate)->toPeriod($endDate, '1 month');

        $creadosLookup = $creados->keyBy(fn($item) => "{$item->year}-{$item->month}");
        $editadosLookup = $editados->keyBy(fn($item) => "{$item->year}-{$item->month}");

        foreach ($period as $date) {
            $year = $date->year;
            $month = $date->month;
            // Corregimos el formato de la clave para que coincida con strftime('%m') (ej: 01, 02)
            $key = sprintf("%d-%02d", $year, $month);
            
            $chartData[] = [
                'fecha' => $date->format('Y-m-01'), 
                'creados' => $creadosLookup->get($key)->count ?? 0,
                'editados' => $editadosLookup->get($key)->count ?? 0,
            ];
        }

        // --- 4. Enviar todo a Inertia ---
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