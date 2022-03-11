<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCartController extends Controller
{
    public function index(): View
    {
        //$items = Cart::getContent();
        return view('cart.index');
    }

    public function store(Request $request): RedirectResponse
    {
        //dd($request->id);
        $product = Product::whereId($request->id)->first();
        //Cart::add(['id' => '293ad', 'name' => 'Product 1', 'qty' => 1, 'price' => 9.99, 'options' => ['size' => 'large']]);
        //dd($product->id);
        Cart::add($product->id, $product->name, 1, $product->price);
        return redirect()->route('cart.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        Cart::remove($product->id);
        return redirect()->route('cart.index');
    }

    public function clear(): RedirectResponse
    {
        Cart::destroy();
        return redirect()->route('products.index');
    }
}
