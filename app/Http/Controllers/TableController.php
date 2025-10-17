<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableRequest;
use App\Models\Table;

class TableController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $tables = Table::latest()->paginate(10);
        return view('tables.index', compact('tables'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('tables.create');
    }

    public function store(TableRequest $request): \Illuminate\Http\RedirectResponse
    {
        Table::create($request->validated());
        return redirect()->route('tables.index')->with('success', 'Created successfully');
    }

    public function show(Table $table): \Illuminate\Contracts\View\View
    {
        return view('tables.show', compact('table'));
    }

    public function edit(Table $table): \Illuminate\Contracts\View\View
    {
        return view('tables.edit', compact('table'));
    }

    public function update(TableRequest $request, Table $table): \Illuminate\Http\RedirectResponse
    {
        $table->update($request->validated());
        return redirect()->route('tables.index')->with('success', 'Updated successfully');
    }

    public function destroy(Table $table): \Illuminate\Http\RedirectResponse
    {
        $table->delete();
        return redirect()->route('tables.index')->with('success', 'Deleted successfully');
    }
}
