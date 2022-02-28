<?php

namespace App\Actions\Admin\Products;

use App\Models\Product;

//use Illuminate\Support\Facades\Validator;

class CreateNewProduct
{
    public function create(array $input): Product
    {
        /***Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();**/
        $product = new Product();
        
        $product->name =  $input['name'];
        $product->code = $input['code'];
        $product->price = $input['price'];
        $product->description = $input['description'];
        $product->stock = $input['stock'];
        //$product->discount = $input['discount'];
        $product->status = $input['status'];
        //$product->file = $input['file'];
        $product->save();
        
        
        return $product;
    }
}
