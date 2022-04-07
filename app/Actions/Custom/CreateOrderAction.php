<?php

namespace App\Actions\Custom;

use App\Models\Order;

class CreateOrderAction
{
    public function create(array $data, ?int $reference): Order
    {
        $order = new Order();
        $order->status = 'CREATED';
        $order->reference = $reference;
        $order->customerName = $data['name'];
        $order->customerDocument = $data['document'];
        $order->customerEmail = $data['email'];
        $order->customer()->associate(auth()->user()->id);
        $order->save();

        return $order;
    }
}
