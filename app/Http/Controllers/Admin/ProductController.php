<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProductStoreRequest;
use App\Http\Requests\AdminProductUpdateRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class ProductController extends Controller
{

    public function index(): View
    {
        //se puede pasar a un scope 
        $products = Product::where('user_id', auth()->user()->id)
            ->latest('id')
            ->paginate(5);
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.products.create', compact('categories'));
    }

    public function store(AdminProductStoreRequest $request): RedirectResponse
    {
        //$request->user_id = auth()->user()->id;
        //dd($request);
        //dd($request->user_id);
        $us = Product::create($request->validated());
        //dd($request->name);
        //dd($request->user_id);
        return redirect()->route('admin.products.index')->with('information','Product created successfully!');
    }

    public function show(Product $product): View
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(AdminProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());
        return redirect()->route('admin.products.index', $product)->with('information', 'Product updated successfully!');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('information', 'Product deleted successfully!');
    }
}
