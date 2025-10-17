<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepreciationRequest;
use App\Models\Depreciation;

class DepreciationController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $depreciations = Depreciation::latest()->paginate(10);
        return view('depreciations.index', compact('depreciations'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('depreciations.create');
    }

    public function store(DepreciationRequest $request): \Illuminate\Http\RedirectResponse
    {
        Depreciation::create($request->validated());
        return redirect()->route('depreciations.index')->with('success', 'Created successfully');
    }

    public function show(Depreciation $depreciation): \Illuminate\Contracts\View\View
    {
        return view('depreciations.show', compact('depreciation'));
    }

    public function edit(Depreciation $depreciation): \Illuminate\Contracts\View\View
    {
        return view('depreciations.edit', compact('depreciation'));
    }

    public function update(DepreciationRequest $request, Depreciation $depreciation): \Illuminate\Http\RedirectResponse
    {
        $depreciation->update($request->validated());
        return redirect()->route('depreciations.index')->with('success', 'Updated successfully');
    }

    public function destroy(Depreciation $depreciation): \Illuminate\Http\RedirectResponse
    {
        $depreciation->delete();
        return redirect()->route('depreciations.index')->with('success', 'Deleted successfully');
    }
}
