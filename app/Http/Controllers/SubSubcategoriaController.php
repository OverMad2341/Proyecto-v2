<?php

namespace App\Http\Controllers;

use App\Models\SubSubcategoria;
use Illuminate\Http\Request;

class SubSubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subsubcategorias = SubSubcategoria::select('id', 'name', 'subcategoria_id')->orderBy('id')->get();

        return response()->json($subsubcategorias);
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
    public function show(SubSubcategoria $subSubcategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubSubcategoria $subSubcategoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubSubcategoria $subSubcategoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubSubcategoria $subSubcategoria)
    {
        //
    }
}
