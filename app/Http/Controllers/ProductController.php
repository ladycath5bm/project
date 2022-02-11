<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::where('status', true)->paginate();
        //dd($products);
        return view('custom.products.index', compact('products'));
    }

    public function show(Product $product): View
    {
        //dd($product);
        //pasar a una consulta e otra capa
        $similarProductsByCategory = Product::where('category_id', $product->category_id)
            ->where('id','!=',$product->id)
            ->where('status', true)
            ->take(3)
            ->get();

        return view('custom.products.show', compact('product', 'similarProductsByCategory'));
    }

    public function showByCategory(Category $category): View
    {
        $products = Product::where('category_id', $category->id)
            ->where('status', true)
            ->paginate(10);
            
        return view('custom.products.index', compact('products'));
    }

}
