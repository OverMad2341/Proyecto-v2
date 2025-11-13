<?php

namespace App\Http\Controllers;

use App\Models\Gerencias;
use Illuminate\Http\Request;

class GerenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ubicacion = Gerencias::select('id', 'name' )->orderBy('name')->get();

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
    public function show(Gerencias $gerencias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gerencias $gerencias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gerencias $gerencias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gerencias $gerencias)
    {
        //
    }
}
