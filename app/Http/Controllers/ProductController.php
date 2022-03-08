<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(): View
    {
        if(request()->page){
            $key = 'products' . request()->page;
        }
        else{
            $key = 'products';
        }

        if (Cache::has($key)) {
            $products = Cache::get($key);
        }
        else{
            $products = Product::where('status', true)
            //->where('user_id', auth()->user()->id)
            ->latest('id')
            ->paginate(20);
            Cache::put($key, $products);
        }

        $categories = Category::all();

        return view('custom.products.index', compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        //dd($product);
        //pasar a una consulta e otra capa
        $similarProductsByCategory = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', true)
            ->take(3)
            ->get();

        return view('custom.products.show', compact('product', 'similarProductsByCategory'));
    }

    public function showByCategory(Category $category): View
    {
        $products = Product::where('category_id', $category->id)
        //where('user_id', auth()->user()->id)
            
            //  ->where('id', '!=', $product->id)
            
            ->where('status', true)
            ->paginate(9);
        $category_id = $category->id;
        return view('custom.products.index', compact('products'));
    }
}
