<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $sub_categories = SubCategory::latest()->paginate(10);
        return view('sub_categories.index', compact('sub_categories'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('sub_categories.create');
    }

    public function store(SubCategoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        SubCategory::create($request->validated());
        return redirect()->route('sub_categories.index')->with('success', 'Created successfully');
    }

    public function show(SubCategory $subCategory): \Illuminate\Contracts\View\View
    {
        return view('sub_categories.show', compact('subCategory'));
    }

    public function edit(SubCategory $subCategory): \Illuminate\Contracts\View\View
    {
        return view('sub_categories.edit', compact('subCategory'));
    }

    public function update(SubCategoryRequest $request, SubCategory $subCategory): \Illuminate\Http\RedirectResponse
    {
        $subCategory->update($request->validated());
        return redirect()->route('sub_categories.index')->with('success', 'Updated successfully');
    }

    public function destroy(SubCategory $subCategory): \Illuminate\Http\RedirectResponse
    {
        $subCategory->delete();
        return redirect()->route('sub_categories.index')->with('success', 'Deleted successfully');
    }
}
