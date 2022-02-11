<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AdminProductStoreRequest;
use App\Http\Requests\AdminCategoryStoreRequest;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::latest('id')->paginate(5);
        //dd($categories);
        return view('admin.categories.index', compact('categories'));   
    }

    
    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(AdminCategoryStoreRequest $request): RedirectResponse
    {
        Category::create($request->validated());
        return redirect()->route('admin.categories.index')->with('information', 'Category created successfully!');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        //integrar validacion
        $category->update($request->validated());
        return redirect()->route('admin.categories.index')->with('information', 'Category updated successfully');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('information', 'Category deleted successfully');
    }
}
