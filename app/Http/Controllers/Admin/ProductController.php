<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
class ProductController extends Controller
{

    public function index(): View
    {
        return view('admin.products.index');
    }

    public function create(): View
    {
        return view('admin.products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //return redirect()->route('admin.products.create)->with('information', 'Products created successfully!');
    }

    public function show(Product $product): View
    {
        //
    }

    public function edit(Product $product): View
    {
        //
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $product->update($request->all());
        return redirect()->route('admin.show.index', $product);
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('information', 'Product deleted successfully!');
    }
}
