<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use App\Models\Empleado;
use App\Models\Gerencia;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\SubSubcategoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ActivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activos = Activo::with(['ubicacion', 'empleado', 'categoria'])->get();

        return Inertia::render('activos/List', [
            'activos' => $activos,
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
        $request->validate([
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
        Activo::create($request->all());
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
            'codigo' => ['required|string|numeric', Rule::unique('activos')->ignore($activo->id),],
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
}
