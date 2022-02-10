<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        dd($products->first());
        
        return view('custom.products.index', compact('products'));
    }

    public function show(Product $product): View
    {
        return view('custom.products.show', compact('product'));
    }

    public function similarsProduct(Product $product)
    {
        $similarProductsByCategory = Product::where('category_id', $product->category_id);
        return ;
    }

}
