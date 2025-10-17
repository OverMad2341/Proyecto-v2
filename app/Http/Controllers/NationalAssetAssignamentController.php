<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\NationalAssetAssignamentRequest;
use App\Models\NationalAssetAssignament;

class NationalAssetAssignamentController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $national_asset_assignaments = NationalAssetAssignament::latest()->paginate(10);
        return view('national_asset_assignaments.index', compact('national_asset_assignaments'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('national_asset_assignaments.create');
    }

    public function store(NationalAssetAssignamentRequest $request): \Illuminate\Http\RedirectResponse
    {
        NationalAssetAssignament::create($request->validated());
        return redirect()->route('national_asset_assignaments.index')->with('success', 'Created successfully');
    }

    public function show(NationalAssetAssignament $nationalAssetAssignament): \Illuminate\Contracts\View\View
    {
        return view('national_asset_assignaments.show', compact('nationalAssetAssignament'));
    }

    public function edit(NationalAssetAssignament $nationalAssetAssignament): \Illuminate\Contracts\View\View
    {
        return view('national_asset_assignaments.edit', compact('nationalAssetAssignament'));
    }

    public function update(NationalAssetAssignamentRequest $request, NationalAssetAssignament $nationalAssetAssignament): \Illuminate\Http\RedirectResponse
    {
        $nationalAssetAssignament->update($request->validated());
        return redirect()->route('national_asset_assignaments.index')->with('success', 'Updated successfully');
    }

    public function destroy(NationalAssetAssignament $nationalAssetAssignament): \Illuminate\Http\RedirectResponse
    {
        $nationalAssetAssignament->delete();
        return redirect()->route('national_asset_assignaments.index')->with('success', 'Deleted successfully');
    }
}
