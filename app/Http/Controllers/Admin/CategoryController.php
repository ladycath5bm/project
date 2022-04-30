<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCategoryStoreRequest;
use App\Http\Requests\AdminCategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /*  public function __construct()
     {
         $this->middleware('can:admin.categories.index');
     }
 */
    public function index(): View
    {
        $categories = Category::paginate(5);
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

    public function update(AdminCategoryUpdateRequest $request, Category $category): RedirectResponse
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
