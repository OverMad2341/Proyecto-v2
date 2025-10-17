<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FederalStateRequest;
use App\Models\FederalState;

class FederalStateController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $federal_states = FederalState::latest()->paginate(10);
        return view('federal_states.index', compact('federal_states'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('federal_states.create');
    }

    public function store(FederalStateRequest $request): \Illuminate\Http\RedirectResponse
    {
        FederalState::create($request->validated());
        return redirect()->route('federal_states.index')->with('success', 'Created successfully');
    }

    public function show(FederalState $federalState): \Illuminate\Contracts\View\View
    {
        return view('federal_states.show', compact('federalState'));
    }

    public function edit(FederalState $federalState): \Illuminate\Contracts\View\View
    {
        return view('federal_states.edit', compact('federalState'));
    }

    public function update(FederalStateRequest $request, FederalState $federalState): \Illuminate\Http\RedirectResponse
    {
        $federalState->update($request->validated());
        return redirect()->route('federal_states.index')->with('success', 'Updated successfully');
    }

    public function destroy(FederalState $federalState): \Illuminate\Http\RedirectResponse
    {
        $federalState->delete();
        return redirect()->route('federal_states.index')->with('success', 'Deleted successfully');
    }
}
