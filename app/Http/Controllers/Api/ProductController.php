<?php

namespace App\Http\Controllers\Api;

use App\Actions\Admin\Products\CreateNewProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminProductStoreRequest;
use App\Http\Requests\Admin\AdminProductUpdateRequest;
use App\Http\Resources\Api\ProductCollection;
use App\Http\Resources\Api\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(): ProductCollection
    {
        $products = Product::all();

        return ProductCollection::make($products)
            ->additional(['message' => 'product list brought successfully']);
    }

    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product)
            ->additional(['message' => 'product displayed successfully']);
    }

    public function store(CreateNewProduct $createNewProduct, AdminProductStoreRequest $request): ProductResource
    {
        return ProductResource::make($createNewProduct->create($request->validated()))
            ->additional(['message' => 'product stored successfully']);
    }

    public function update(AdminProductUpdateRequest $request, Product $product): ProductResource
    {
        $product->update($request->validated());

        return ProductResource::make($product)
            ->additional(['message' => 'product updated successfully']);
    }

    public function destroy(Product $product): ProductResource
    {
        $product->delete();

        return ProductResource::make($product)
            ->additional(['message' => 'product deleted successfully']);
    }
}
