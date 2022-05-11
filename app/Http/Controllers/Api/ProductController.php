<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\ProductCollection;
use App\Http\Requests\AdminProductStoreRequest;
use App\Actions\Admin\Products\CreateNewProduct;

class ProductController extends Controller
{
    public function index(): ProductCollection
    {
        $products = Product::all();

        return ProductCollection::make($products);
    }

    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }

    public function store(CreateNewProduct $createNewProduct, AdminProductStoreRequest $request)
    {
        $product = $createNewProduct->create($request->validated());
        
        if ($request->hasfile('file')){
            $request->file('file')->storeAs('public', $request->file('file')->hashName());
            $product->images()->create(['url' => $request->file('file')->hashName()]);
        }

        return redirect()->route('api.products.show', $product);
    }
}
