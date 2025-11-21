<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use App\Models\Empleado;
use App\Models\Gerencia;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\SubSubcategoria;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ActivosImport;
use App\Exports\ActivosExport;

class ActivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ACTUALIZADO: Usamos 'custodio' y 'gerencia' en el eager loading
        $activos = Activo::with(['custodio', 'gerencia', 'categoria'])->get();
        
        return Inertia::render('activos/List', [
            'activos' => $activos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('activos/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigo' => 'required|string|numeric',
            'serial' => 'nullable|string|max:100',
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'color' => 'nullable|string|max:100',
            'estado' => 'required|string|max:100',
            'empleado' => 'nullable|integer|exists:empleados,id',
            'ubicacion' => 'required|integer|exists:gerencias,id',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'subcategoria_id' => 'required|integer|exists:subcategorias,id',
            'subsubcategoria_id' => 'required|integer|exists:subsubcategorias,id',
        ]);
        Activo::create($validatedData);
        return redirect()->route('Activo.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activo $activos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activo $activo)
    {
        return Inertia::render('activos/Edit', [
            // 1. El activo específico que estamos editando
            'activo' => $activo,

            // 2. Todas las listas que tus <Select> necesitan
            // (Optimizamos para traer solo las columnas necesarias)
            'empleados' => Empleado::all(['id', 'name', 'surname', 'cedula']),
            'gerencias' => Gerencia::all(['id', 'name']),
            'categorias' => Categoria::all(['id', 'name']),
            'subcategorias' => Subcategoria::all(['id', 'name', 'categoria_id']),
            'subsubcategorias' => SubSubcategoria::all(['id', 'name', 'subcategoria_id']), 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activo $activo)
    {

        $validatedData = $request->validate([
            'codigo' => [
                'required', 
                'string', 
                'numeric', 
                Rule::unique('activos')->ignore($activo->id)
            ],
            'serial' => 'nullable|string|max:100',
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'color' => 'nullable|string|max:100',
            'estado' => 'required|string|max:100',
            'empleado' => 'nullable|integer|exists:empleados,id',
            'ubicacion' => 'required|integer|exists:gerencias,id',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'subcategoria_id' => 'required|integer|exists:subcategorias,id',
            'subsubcategoria_id' => 'required|integer|exists:subsubcategorias,id',
        ]);
        $activo->update($validatedData);
        return redirect()->route('Activo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activo $activos)
    {
        //
    }

    public function export(Request $request)
    {
        $ids = $request->query('ids');
        $format = $request->query('format', 'xlsx');
        
        if (!$ids) {
            return back()->with('error', 'No has seleccionado ningún activo.');
        }

        $idsArray = explode(',', $ids);
        $extension = strtolower($format) === 'ods' ? 'ods' : 'xlsx';
        $writerType = strtolower($format) === 'ods' 
            ? \Maatwebsite\Excel\Excel::ODS 
            : \Maatwebsite\Excel\Excel::XLSX;

        return Excel::download(
            new ActivosExport($idsArray), 
            "bienes_seleccionados.{$extension}", 
            $writerType
        );
    }

    public function importPreview(Request $request)
    {
        // CORRECCIÓN AQUÍ:
        // 1. Agregamos 'zip' a mimes porque los ODS/XLSX son zips internamente.
        // 2. Mantenemos 'extensions' para asegurar que no suban cualquier .zip
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,ods,csv,zip,application/zip,application/vnd.oasis.opendocument.spreadsheet',
                'extensions:xlsx,xls,ods,csv'
            ]
        ], [
            'file.mimes' => 'El formato interno del archivo no es válido. Asegúrate de que no esté corrupto.',
            'file.extensions' => 'El archivo debe tener una extensión válida (.xlsx, .ods).',
        ]);

        try {
            $data = Excel::toArray(new ActivosImport, $request->file('file'));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'No se pudo leer el archivo. Puede estar corrupto o tener un formato no soportado.'
            ], 422);
        }

        $rows = $data[0] ?? [];
        
        if (empty($rows)) {
            return response()->json(['message' => 'El archivo parece estar vacío.'], 422);
        }

        $processedData = [];

        foreach ($rows as $index => $row) {
            // Saltamos filas vacías o sin código
            if (!isset($row['codigo'])) continue;

            $codigoExiste = Activo::where('codigo', $row['codigo'])->exists();
            $ubicacion = Gerencia::where('name', $row['ubicacion'])->first();
            
            $categoria = null;
            if (!empty($row['categoria'])) {
                $categoria = Categoria::where('name', $row['categoria'])->first();
            }

            $subcategoria = null;
            if ($categoria && !empty($row['subcategoria'])) {
                $subcategoria = Subcategoria::where('name', $row['subcategoria'])
                                            ->where('categoria_id', $categoria->id)
                                            ->first();
            }

            $subsubcategoria = null;
            if ($subcategoria && !empty($row['subsubcategoria'])) {
                $subsubcategoria = Subsubcategoria::where('name', $row['subsubcategoria'])
                                                ->where('subcategoria_id', $subcategoria->id)
                                                ->first();
            }

            $errorMessages = [];
            if ($codigoExiste) $errorMessages[] = "Código duplicado.";
            if (!$ubicacion) $errorMessages[] = "Ubicación desconocida.";
            if (!$categoria) $errorMessages[] = "Categoría desconocida.";

            $processedData[] = [
                'temp_id' => $index,
                'codigo' => $row['codigo'],
                'serial' => $row['serial'],
                'marca' => $row['marca'],
                'modelo' => $row['modelo'],
                'color' => $row['color'] ?? '',
                'estado' => $row['estado'],
                'ubicacion_nombre' => $row['ubicacion'] ?? '',
                'categoria_nombre' => $row['categoria'] ?? '',
                'subcategoria_nombre' => $row['subcategoria'] ?? '',
                'subsubcategoria_nombre' => $row['subsubcategoria'] ?? '',
                'ubicacion_id' => $ubicacion?->id,
                'categoria_id' => $categoria?->id,
                'subcategoria_id' => $subcategoria?->id,
                'subsubcategoria_id' => $subsubcategoria?->id,
                'has_error' => count($errorMessages) > 0,
                'error_message' => implode(' ', $errorMessages),
            ];
        }

        return response()->json([
            'data' => $processedData,
            'message' => 'Archivo procesado.'
        ]);
    }

    public function importStore(Request $request)
    {
        $data = $request->input('activos');

        if (empty($data)) {
            return back()->with('error', 'No hay datos.');
        }

        $count = 0;
        foreach ($data as $row) {
            if (Activo::where('codigo', $row['codigo'])->exists()) continue;

            Activo::create([
                'codigo' => $row['codigo'],
                'serial' => $row['serial'],
                'marca' => $row['marca'],
                'modelo' => $row['modelo'],
                'color' => $row['color'],
                'estado' => $row['estado'],
                'ubicacion' => $row['ubicacion_id'],
                'categoria_id' => $row['categoria_id'],
                'subcategoria_id' => $row['subcategoria_id'],
                'subsubcategoria_id' => $row['subsubcategoria_id'],
                'empleado' => null,
            ]);
            $count++;
        }

        return redirect()->route('Activo.index')->with('success', "$count activos importados.");
    }
}
