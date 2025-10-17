<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $employees = Employee::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('employees.create');
    }

    public function store(EmployeeRequest $request): \Illuminate\Http\RedirectResponse
    {
        Employee::create($request->validated());
        return redirect()->route('employees.index')->with('success', 'Created successfully');
    }

    public function show(Employee $employee): \Illuminate\Contracts\View\View
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee): \Illuminate\Contracts\View\View
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, Employee $employee): \Illuminate\Http\RedirectResponse
    {
        $employee->update($request->validated());
        return redirect()->route('employees.index')->with('success', 'Updated successfully');
    }

    public function destroy(Employee $employee): \Illuminate\Http\RedirectResponse
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Deleted successfully');
    }
}
