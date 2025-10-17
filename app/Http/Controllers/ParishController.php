<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParishRequest;
use App\Models\Parish;

class ParishController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $parishes = Parish::latest()->paginate(10);
        return view('parishes.index', compact('parishes'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('parishes.create');
    }

    public function store(ParishRequest $request): \Illuminate\Http\RedirectResponse
    {
        Parish::create($request->validated());
        return redirect()->route('parishes.index')->with('success', 'Created successfully');
    }

    public function show(Parish $parish): \Illuminate\Contracts\View\View
    {
        return view('parishes.show', compact('parish'));
    }

    public function edit(Parish $parish): \Illuminate\Contracts\View\View
    {
        return view('parishes.edit', compact('parish'));
    }

    public function update(ParishRequest $request, Parish $parish): \Illuminate\Http\RedirectResponse
    {
        $parish->update($request->validated());
        return redirect()->route('parishes.index')->with('success', 'Updated successfully');
    }

    public function destroy(Parish $parish): \Illuminate\Http\RedirectResponse
    {
        $parish->delete();
        return redirect()->route('parishes.index')->with('success', 'Deleted successfully');
    }
}
