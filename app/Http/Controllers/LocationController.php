<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Models\Location;

class LocationController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $locations = Location::latest()->paginate(10);
        return view('locations.index', compact('locations'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('locations.create');
    }

    public function store(LocationRequest $request): \Illuminate\Http\RedirectResponse
    {
        Location::create($request->validated());
        return redirect()->route('locations.index')->with('success', 'Created successfully');
    }

    public function show(Location $location): \Illuminate\Contracts\View\View
    {
        return view('locations.show', compact('location'));
    }

    public function edit(Location $location): \Illuminate\Contracts\View\View
    {
        return view('locations.edit', compact('location'));
    }

    public function update(LocationRequest $request, Location $location): \Illuminate\Http\RedirectResponse
    {
        $location->update($request->validated());
        return redirect()->route('locations.index')->with('success', 'Updated successfully');
    }

    public function destroy(Location $location): \Illuminate\Http\RedirectResponse
    {
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Deleted successfully');
    }
}
