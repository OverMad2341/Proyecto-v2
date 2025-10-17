<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovementHistoryRequest;
use App\Models\MovementHistory;

class MovementHistoryController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $movement_histories = MovementHistory::latest()->paginate(10);
        return view('movement_histories.index', compact('movement_histories'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('movement_histories.create');
    }

    public function store(MovementHistoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        MovementHistory::create($request->validated());
        return redirect()->route('movement_histories.index')->with('success', 'Created successfully');
    }

    public function show(MovementHistory $movementHistory): \Illuminate\Contracts\View\View
    {
        return view('movement_histories.show', compact('movementHistory'));
    }

    public function edit(MovementHistory $movementHistory): \Illuminate\Contracts\View\View
    {
        return view('movement_histories.edit', compact('movementHistory'));
    }

    public function update(MovementHistoryRequest $request, MovementHistory $movementHistory): \Illuminate\Http\RedirectResponse
    {
        $movementHistory->update($request->validated());
        return redirect()->route('movement_histories.index')->with('success', 'Updated successfully');
    }

    public function destroy(MovementHistory $movementHistory): \Illuminate\Http\RedirectResponse
    {
        $movementHistory->delete();
        return redirect()->route('movement_histories.index')->with('success', 'Deleted successfully');
    }
}
