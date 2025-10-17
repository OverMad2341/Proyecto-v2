<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgentRequest;
use App\Models\Agent;
use Inertia\Inertia;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::latest()->paginate(10);

        return Inertia::render('agents/Index', [
            'agents' => $agents->through(fn($agent) => [
                'id' => $agent->id,
                'name' => $agent->name ?? null,
                'email' => $agent->email ?? null,
                'phone' => $agent->phone ?? null,
                'created_at' => $agent->created_at?->toDateTimeString(),
            ]),
            'routes' => [
                'create' => route('agents.create'),
                'store' => route('agents.store'),
                'edit' => route('agents.edit', ['agent' => '__id__']),
                'update' => route('agents.update', ['agent' => '__id__']),
                'destroy' => route('agents.destroy', ['agent' => '__id__']),
            ],
            'meta' => [
                'links' => $agents->linkCollection(),
                'pagination' => [
                    'total' => $agents->total(),
                    'per_page' => $agents->perPage(),
                    'current_page' => $agents->currentPage(),
                    'last_page' => $agents->lastPage(),
                ],
            ],
        ]);
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('agents.create');
    }

    public function store(AgentRequest $request): \Illuminate\Http\RedirectResponse
    {
        Agent::create($request->validated());
        return redirect()->route('agents.index')->with('success', 'Created successfully');
    }

    public function show(Agent $agent): \Illuminate\Contracts\View\View
    {
        return view('agents.show', compact('agent'));
    }

    public function edit(Agent $agent): \Illuminate\Contracts\View\View
    {
        return view('agents.edit', compact('agent'));
    }

    public function update(AgentRequest $request, Agent $agent): \Illuminate\Http\RedirectResponse
    {
        $agent->update($request->validated());
        return redirect()->route('agents.index')->with('success', 'Updated successfully');
    }

    public function destroy(Agent $agent): \Illuminate\Http\RedirectResponse
    {
        $agent->delete();
        return redirect()->route('agents.index')->with('success', 'Deleted successfully');
    }
}
