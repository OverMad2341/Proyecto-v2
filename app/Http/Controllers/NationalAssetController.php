<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\NationalAssetRequest;
use App\Models\NationalAsset;

class NationalAssetController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $national_assets = NationalAsset::latest()->paginate(10);
        return view('national_assets.index', compact('national_assets'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('national_assets.create');
    }

    public function store(NationalAssetRequest $request): \Illuminate\Http\RedirectResponse
    {
        NationalAsset::create($request->validated());
        return redirect()->route('national_assets.index')->with('success', 'Created successfully');
    }

    public function show(NationalAsset $nationalAsset): \Illuminate\Contracts\View\View
    {
        return view('national_assets.show', compact('nationalAsset'));
    }

    public function edit(NationalAsset $nationalAsset): \Illuminate\Contracts\View\View
    {
        return view('national_assets.edit', compact('nationalAsset'));
    }

    public function update(NationalAssetRequest $request, NationalAsset $nationalAsset): \Illuminate\Http\RedirectResponse
    {
        $nationalAsset->update($request->validated());
        return redirect()->route('national_assets.index')->with('success', 'Updated successfully');
    }

    public function destroy(NationalAsset $nationalAsset): \Illuminate\Http\RedirectResponse
    {
        $nationalAsset->delete();
        return redirect()->route('national_assets.index')->with('success', 'Deleted successfully');
    }
}
