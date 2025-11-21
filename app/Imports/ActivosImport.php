<?php

namespace App\Imports;

use App\Models\Activo;
use App\Models\Gerencia;
use App\Models\Categoria;
use App\Models\Empleado;
use App\Models\Subcategoria;
use App\Models\Subsubcategoria;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ActivosImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // 1. Buscar Ubicación (Gerencia)
        // Asume que el excel tiene columna 'ubicacion' con el nombre exacto
        $ubicacion = Gerencia::where('name', $row['ubicacion'])->first();
        $empleado = Empleado::where('name', $row['empleado'])->first();

        // 2. Resolver Jerarquía de Categorías
        $categoria = null;
        $subcategoria = null;
        $subsubcategoria = null;

        // Buscar ID de Categoria
        if (!empty($row['categoria'])) {
            $categoria = Categoria::where('name', $row['categoria'])->first();
        }

        // Buscar ID de Subcategoria (Solo si existe la categoria padre)
        if ($categoria && !empty($row['subcategoria'])) {
            $subcategoria = Subcategoria::where('name', $row['subcategoria'])
                                        ->where('categoria_id', $categoria->id)
                                        ->first();
        }

        // Buscar ID de Subsubcategoria (Solo si existe la subcategoria padre)
        if ($subcategoria && !empty($row['subsubcategoria'])) {
            $subsubcategoria = Subsubcategoria::where('name', $row['subsubcategoria'])
                                              ->where('subcategoria_id', $subcategoria->id)
                                              ->first();
        }

        return new Activo([
            'codigo'              => $row['codigo'],
            'serial'              => $row['serial'],
            'marca'               => $row['marca'],
            'modelo'              => $row['modelo'],
            'color'               => $row['color'] ?? null,
            'estado'              => $row['estado'], // Ej: 'Operativo', 'Dañado'
            
            'ubicacion'           => $ubicacion?->id,
            'categoria_id'        => $categoria?->id,
            'subcategoria_id'     => $subcategoria?->id,
            'subsubcategoria_id'  => $subsubcategoria?->id,
            
            // Nota: Empleado suele ser más complejo (por cédula o correo), 
            // por ahora lo dejo null o puedes agregar lógica similar a Ubicación
            'empleado'            => $empleado?->id, 
        ]);
    }

    /**
     * Reglas de validación para asegurar que el Excel tenga datos coherentes
     */
    public function rules(): array
    {
        return [
            'codigo' => 'required|unique:activos,codigo', // Evita duplicados
            'marca'  => 'required',
            'estado' => 'required',
            'categoria' => 'required',
        ];
    }
}