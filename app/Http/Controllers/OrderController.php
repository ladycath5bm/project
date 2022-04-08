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
        $orders = Order::select('id', 'total', 'description', 'status', 'created_at', 'reference', 'requestId', 'processUrl')
            ->where('customer_id', auth()->user()->id)
            ->latest('id')
            ->paginate(5);
        return view('orders.index', compact('orders'));
    }

    public static function store(Request $request): Order
    {
        $createNewOrderAction = new CreateOrderAction();
        $reference = Order::select('reference')
            ->where('customer_id', auth()->user()->id)
            ->latest('id')->first()->reference + 1;
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
}
