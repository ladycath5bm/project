<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all()->paginate(10);
        return view('custom.products.index', compact('products'));
    }

    public function show(Product $product): View
    {
        return view('custom.products.show', compact('product'));
    }

}
