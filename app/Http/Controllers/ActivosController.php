<?php

namespace App\Http\Controllers;

use App\Models\Activos;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('activos/List', [
            'activos' => Activos::all(),
            // 'activos' => Activos::paginate(10),
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
            'codigo' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'serial' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'empleado' => 'required|interger',
            'ubicacion' => 'required|interger',
            'categoria_id' => 'required|integer',
            'subcategoria_id' => 'required|integer',
            'sub_subcategoria_id' => 'required|integer',
        ]);
        Activos::create($request->all());
        return redirect()->route('activos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activos $activos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activos $activos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activos $activos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activos $activos)
    {
        //
    }
}
