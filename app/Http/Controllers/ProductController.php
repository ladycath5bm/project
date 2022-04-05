<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(): View
    {
        if (request()->page) {
            $key = 'products' . request()->page;
        } else {
            $key = 'products';
        }

        if (Cache::has($key)) {
            $products = Cache::get($key);
        } else {
            $products = Product::where('status', true)
            ->latest('id')
            ->paginate(8);
            Cache::put($key, $products);
        }

        $categories = Category::all();

        return view('custom.products.index', compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        //pasar a una consulta e otra capa
        $categories = Category::all();
        $similarProductsByCategory = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', true)
            ->take(4)
            ->get();

        return view('custom.products.show', compact('product', 'similarProductsByCategory', 'categories'));
    }

    public function showByCategory(Category $category): View
    {
        $categories = Category::all();
        $products = Product::where('category_id', $category->id)
            ->where('status', true)
            ->paginate(9);
        $category_id = $category->id;
        return view('custom.products.index', compact('products', 'categories'));
    }
}
