<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;
use App\Actions\Custom\CreateOrderAction;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\Payments\PlacetoPay\Buyer;
use App\Services\Payments\PlacetoPay\Payment;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::select('id', 'total', 'description', 'status', 'created_at','reference', 'requestId', 'processUrl')
            ->where('customer_id', auth()->user()->id)
            ->latest('id')
            ->paginate(5);
        return view('orders.index', compact('orders'));
    }

    public static function store(Request $request): Order
    {
        $createNewOrderAction = new CreateOrderAction(); 
        $reference = Order::select('id')->latest()->first()->reference + 1;
        $order = $createNewOrderAction->create($request, $reference);
       
        return $order;
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

    public function cancel(Order $order): RedirectResponse
    {
        $orderCancel = Order::where('id', $order->id)->first();
        $orderCancel->status = 'REJECTED';
        $orderCancel->save();

        return redirect()->route('cart.index');
    }

}
