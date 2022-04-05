<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Actions\Custom\CreateOrderAction;
use Illuminate\Contracts\View\View;

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

    public function update(Request $request, $id)
    {
        //
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
