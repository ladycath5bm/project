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
        //dd($product);
        return view('custom.products.show', compact('product'));
    }

    public function similarsProduct(Product $product)
    {
        $similarProductsByCategory = Product::where('category_id', $product->category_id);
        return ;
    }

}
