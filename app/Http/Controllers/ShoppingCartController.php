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
        $items = Cart::getContent();
        return view('cart', compact('items'));
    }

    public function store(Request $request): RedirectResponse
    {
        $product = Product::whereid($request->id)->firstOrFail();
        //Cart::add(['id' => '293ad', 'name' => 'Product 1', 'qty' => 1, 'price' => 9.99, 'options' => ['size' => 'large']]);
        Cart::add($product->id, $product->name, 1, $product->price);
        return back();
    }

    public function destroy(Product $product): RedirectResponse
    {
        Cart::remove($product->id);
        return redirect()->route('cart.index');
    }

    public function clear()
    {
        Cart::destroy();
        return redirect()->route('products.index');
    }
}
