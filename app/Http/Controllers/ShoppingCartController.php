<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index(): View
    {
        return view('cart.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $product = Product::whereId($request->id)->first();

        Cart::add($product->id, $product->name, 1, $product->price, [
            'url' => $product->images->first() ? $product->images()->first()->url : 'img_soport.jpg',
            'code' => $product->code,
            'discount' => $product->discount,
            'stock' => $product->stock,
        ]);

        return redirect()->route('cart.index');
    }

    public function update(Request $request)
    {
        Cart::update($request->id, $request->qty);
        return redirect()->route('cart.index');
    }

    public function remove(string $id): RedirectResponse
    {
        Cart::remove($id);
        return redirect()->route('cart.index');
    }

    public function clear(): RedirectResponse
    {
        Cart::destroy();
        return redirect()->route('cart.index');
    }

    public function checkout(): View
    {
        $items = Cart::content(auth()->user()->id);
        return view('cart.checkout', compact('items'));
    }
}
