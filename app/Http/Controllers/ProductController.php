<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        return view('custom.products.index', compact('products'));
    }

    public function show(Product $product): View
    {
        return view('custom.products.show', compact('product'));
    }

}
