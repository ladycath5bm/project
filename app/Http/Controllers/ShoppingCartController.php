<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ShoppingCartController extends Controller
{
    public function index(): View
    {
        //dd(Cart::restore("12"));
        if (Cart::content(auth()->user()->id)) {
            $items = Cart::content(auth()->user()->id);
        //dd($items);
        } else {
            $items = Cart::content();
        }
        
        return view('cart.index', compact('items'));
    }

    public function update()
    {
        //
    }

    public function store(Request $request): RedirectResponse
    {
        //dd($request->id);
        $product = Product::whereId($request->id)->first();
        //Cart::add(['id' => '293ad', 'name' => 'Product 1', 'qty' => 1, 'price' => 9.99, 'options' => ['size' => 'large']]);

        Cart::add($product->id, $product->name, 1, $product->price, [
            'url' => $product->images->first()->url,
            'code' => $product->code,
            'discount' => $product->discount,
            'stock' => $product->stock,
        ]);
        Cart::instance('default')->store((string) auth()->user()->id);
        return redirect()->route('cart.index');
    }

    public function remove(string $id): RedirectResponse
    {
        //dd($id);
        Cart::remove($id);
        return redirect()->route('cart.index');
    }

    public function clear(): RedirectResponse
    {
        Cart::destroy();
        return redirect()->route('cart.index');
    }

    public function checkout(?Order $order, request $request)
    {
        //dd($request->all());
        // $order = Order::where('id', $order->id);
        $items = Cart::content(auth()->user()->id);
        return view('cart.checkout', compact('items'));
    }
}
