<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        Category::create($request->validated());
        return redirect()->route('categories.index')->with('success', 'Created successfully');
    }

    public function show(Category $category): \Illuminate\Contracts\View\View
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category): \Illuminate\Contracts\View\View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category): \Illuminate\Http\RedirectResponse
    {
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', 'Updated successfully');
    }

    public function destroy(Category $category): \Illuminate\Http\RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Deleted successfully');
    }
}
