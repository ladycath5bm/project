<?php

namespace App\Actions\Custom;

use App\Models\Order;
use Illuminate\Http\Request;

class CreateOrderAction
{
    public function create(Request $request, ?int $reference): Order
    {
        $order = new Order();
        $order->status = 'CREATED';
        $order->reference = $reference;
        $order->customerName = $request['name'];
        $order->customerDocument = $request['document'];
        $order->customerEmail = $request['email'];
        $order->customerPhone = $request['mobile'];
        $order->customerAddress = $request['address'];
        $order->customer()->associate(auth()->user()->id);
        $order->save();

        return $order;
    }
}
