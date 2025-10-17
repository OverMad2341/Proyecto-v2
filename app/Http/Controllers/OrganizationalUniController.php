<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationalUniRequest;
use App\Models\OrganizationalUni;

class OrganizationalUniController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $organizational_unis = OrganizationalUni::latest()->paginate(10);
        return view('organizational_unis.index', compact('organizational_unis'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('organizational_unis.create');
    }

    public function store(OrganizationalUniRequest $request): \Illuminate\Http\RedirectResponse
    {
        OrganizationalUni::create($request->validated());
        return redirect()->route('organizational_unis.index')->with('success', 'Created successfully');
    }

    public function show(OrganizationalUni $organizationalUni): \Illuminate\Contracts\View\View
    {
        return view('organizational_unis.show', compact('organizationalUni'));
    }

    public function edit(OrganizationalUni $organizationalUni): \Illuminate\Contracts\View\View
    {
        return view('organizational_unis.edit', compact('organizationalUni'));
    }

    public function update(OrganizationalUniRequest $request, OrganizationalUni $organizationalUni): \Illuminate\Http\RedirectResponse
    {
        $organizationalUni->update($request->validated());
        return redirect()->route('organizational_unis.index')->with('success', 'Updated successfully');
    }

    public function destroy(OrganizationalUni $organizationalUni): \Illuminate\Http\RedirectResponse
    {
        $organizationalUni->delete();
        return redirect()->route('organizational_unis.index')->with('success', 'Deleted successfully');
    }
}
