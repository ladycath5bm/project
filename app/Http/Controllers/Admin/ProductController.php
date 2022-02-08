<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProductStoreRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class ProductController extends Controller
{

    public function index(): View
    {
        //se puede pasar a un scope 
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('admin.products.create');
    }

    public function store(AdminProductStoreRequest $request): RedirectResponse
    {
        Product::create($request->validated());

        return redirect()->route('admin.products.index')->with('informaction','Product created successfully!');
    }

    public function show(Product $product)
    {
        //return view();
    }

    public function edit(Product $product)
    {
        //return view();
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $product->update($request->all());
        return redirect()->route('admin.products.index', $product)->with('information', 'Product updated successfully!');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('information', 'Product deleted successfully!');
    }
}
