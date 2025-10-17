<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MunicipalityRequest;
use App\Models\Municipality;

class MunicipalityController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $municipalities = Municipality::latest()->paginate(10);
        return view('municipalities.index', compact('municipalities'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('municipalities.create');
    }

    public function store(MunicipalityRequest $request): \Illuminate\Http\RedirectResponse
    {
        Municipality::create($request->validated());
        return redirect()->route('municipalities.index')->with('success', 'Created successfully');
    }

    public function show(Municipality $municipality): \Illuminate\Contracts\View\View
    {
        return view('municipalities.show', compact('municipality'));
    }

    public function edit(Municipality $municipality): \Illuminate\Contracts\View\View
    {
        return view('municipalities.edit', compact('municipality'));
    }

    public function update(MunicipalityRequest $request, Municipality $municipality): \Illuminate\Http\RedirectResponse
    {
        $municipality->update($request->validated());
        return redirect()->route('municipalities.index')->with('success', 'Updated successfully');
    }

    public function destroy(Municipality $municipality): \Illuminate\Http\RedirectResponse
    {
        $municipality->delete();
        return redirect()->route('municipalities.index')->with('success', 'Deleted successfully');
    }
}
