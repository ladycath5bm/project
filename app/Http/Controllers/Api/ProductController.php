<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\ProductCollection;
use App\Http\Requests\AdminProductStoreRequest;
use App\Actions\Admin\Products\CreateNewProduct;
use App\Http\Requests\AdminProductUpdateRequest;
use Illuminate\Http\RedirectResponse;

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

    public function update(AdminProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()->route('api.products.show', $product);
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('api.products.index');
    }
}
