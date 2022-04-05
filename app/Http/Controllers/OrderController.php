<?php

namespace App\Http\Controllers;

use App\Actions\Custom\CreateOrderAction;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::where('customer_id', auth()->user()->id)
            ->latest('id')
            ->paginate(5);
        //dd($orders->toArray());
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
    }

    public function store(CreateOrderAction $createNewOrderAction, Request $request)
    {
        //$order = $createNewOrderAction->create($request->validated());
    }

    public function show($id)
    {
        //
    }

    public function completed(int $id)
    {
        $order = Order::finOrfail('id', $id);
        if ($order->status == 'APROVED') {
            Cart::destroy();
        }
    }

    public function cancel(Order $order)
    {
        //dd($order);
        $orderCancel = Order::where('id', $order->id)->first();
        $orderCancel->status = 'REJECTED';
        $orderCancel->save();

        //dd($orderCancel->first()->id);
        return redirect()->route('cart.index');
    }
}
