<?php

namespace App\Http\Controllers;

use App\Models\Gerencia;
use Illuminate\Http\Request;

class GerenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ubicacion = Gerencia::select('id', 'name' )->orderBy('id')->get();

        return response()->json($ubicacion);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Gerencia $gerencias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gerencia $gerencias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gerencia $gerencias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gerencia $gerencias)
    {
        //
    }
}
