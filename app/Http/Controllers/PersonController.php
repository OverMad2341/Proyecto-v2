<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonRequest;
use App\Models\Person;

class PersonController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $people = Person::latest()->paginate(10);
        return view('people.index', compact('people'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('people.create');
    }

    public function store(PersonRequest $request): \Illuminate\Http\RedirectResponse
    {
        Person::create($request->validated());
        return redirect()->route('people.index')->with('success', 'Created successfully');
    }

    public function show(Person $person): \Illuminate\Contracts\View\View
    {
        return view('people.show', compact('person'));
    }

    public function edit(Person $person): \Illuminate\Contracts\View\View
    {
        return view('people.edit', compact('person'));
    }

    public function update(PersonRequest $request, Person $person): \Illuminate\Http\RedirectResponse
    {
        $person->update($request->validated());
        return redirect()->route('people.index')->with('success', 'Updated successfully');
    }

    public function destroy(Person $person): \Illuminate\Http\RedirectResponse
    {
        $person->delete();
        return redirect()->route('people.index')->with('success', 'Deleted successfully');
    }
}
