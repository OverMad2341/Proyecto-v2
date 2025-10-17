<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Models\Team;

class TeamController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $teams = Team::latest()->paginate(10);
        return view('teams.index', compact('teams'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('teams.create');
    }

    public function store(TeamRequest $request): \Illuminate\Http\RedirectResponse
    {
        Team::create($request->validated());
        return redirect()->route('teams.index')->with('success', 'Created successfully');
    }

    public function show(Team $team): \Illuminate\Contracts\View\View
    {
        return view('teams.show', compact('team'));
    }

    public function edit(Team $team): \Illuminate\Contracts\View\View
    {
        return view('teams.edit', compact('team'));
    }

    public function update(TeamRequest $request, Team $team): \Illuminate\Http\RedirectResponse
    {
        $team->update($request->validated());
        return redirect()->route('teams.index')->with('success', 'Updated successfully');
    }

    public function destroy(Team $team): \Illuminate\Http\RedirectResponse
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Deleted successfully');
    }
}
