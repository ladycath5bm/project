<?php

namespace App\Actions;

use App\Models\Order;

class CreateOrderAction
{
    public function create(int $reference, array $data): Order
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
