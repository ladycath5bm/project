<?php

namespace App\Http\Controllers;

use App\Events\ProductVisited;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVisit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
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
            ->paginate(16);
            Cache::put($key, $products);
        }

        $categories = Category::select('id', 'name')->get();

        return view('custom.products.index', compact('products', 'categories'));
    }

    public function show(Product $product, Request $request): View
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();

        ProductVisited::dispatch($product, $request->ip(), $request->userAgent());

        $categories = Category::select('id', 'name')->get();

        $similarProductsByCategory = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', true)
            ->take(4)
            ->get();

        return view('custom.products.show', compact('product', 'similarProductsByCategory', 'categories'));
    }

    public function showByCategory(Category $category): View
    {
        $categories = Category::select('id', 'name')->get();

        $products = Product::where('category_id', $category->id)
            ->where('status', true)
            ->paginate(9);
        $category_id = $category->id;

        return view('custom.products.index', compact('products', 'categories'));
    }

    public function top(): View
    {
        $categories = Category::select('id', 'name')->get();

        $top = ProductVisit::select('product_id')->selectRaw('count(product_id) as visits')
            ->with('product:id,name,description,code,price')
            ->groupBy('product_id')
            ->orderBy('visits', 'DESC')
            ->limit(10)
            ->get();

        return view('custom.products.top', compact('top', 'categories'));
    }
}
