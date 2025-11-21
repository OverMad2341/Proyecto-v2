<?php

namespace App\Exports;

use App\Models\Activo;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ActivosExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    protected $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    public function query()
    {
        return Activo::query()
            ->whereIn('id', $this->ids)
            // Cargamos las nuevas relaciones renombradas
            ->with([
                'gerencia', 
                'custodio', 
                'categoria', 
                'subcategoria', 
                'subsubcategoria'
            ]);
    }

    public function map($activo): array
    {
        return [
            $activo->codigo,
            $activo->serial,
            $activo->marca,
            $activo->modelo,
            $activo->color,
            $activo->estado,
            
            // Accedemos a la relación, no a la columna
            $activo->gerencia?->name ?? 'Sin Ubicación',
            $activo->custodio ? ($activo->custodio->name . ' ' . $activo->custodio->surname) : 'Sin Asignar',
            
            $activo->categoria?->name ?? 'N/A',
            $activo->subcategoria?->name ?? 'N/A',
            $activo->subsubcategoria?->name ?? 'N/A',
        ];
    }

    public function headings(): array
    {
        return [
            'Código',
            'Serial',
            'Marca',
            'Modelo',
            'Color',
            'Estado',
            'Ubicación',
            'Custodio',
            'Categoría',
            'Subcategoría',
            'Subsubcategoría',
        ];
    }
}