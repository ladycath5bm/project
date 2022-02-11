<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('id', auth()->user()->id);
        //dd($categories);
        return view('admin.categories.index', compact('categories'));   
    }

    
    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('admin.categories.index');
    }


    public function show(Category $category): View
    {
        return view('admin.categories.show');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        //integrar validacion
        $category->update($request->all());
        return redirect()->route('admin.caegories.index')->with('info', 'Category updated successfully');
    }

    public function destroy(Category $category): RedirectResponse
    {
        return redirect()->route('admin.categories.index')->with('info', 'Category deleted successfully');
    }
}
