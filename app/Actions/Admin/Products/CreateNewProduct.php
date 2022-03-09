<?php

namespace App\Actions\Admin\Products;

use App\Models\Product;

//use Illuminate\Support\Facades\Validator;

class CreateNewProduct
{
    public function create(array $input): Product
    {
        $product = new Product();
        
        $product->name =  $input['name'];
        $product->code = $input['code'];
        $product->price = $input['price'];
        $product->description = $input['description'];
        $product->stock = $input['stock'];
        //$product->discount = $input['discount'];
        $product->status = $input['status'];
        //$product->file = $input['file'];
        $product->category()->associate($input['category_id']);
        $product->user()->associate($input['user_id']);
        $product->save();
        
        
        return $product;
    }
}
