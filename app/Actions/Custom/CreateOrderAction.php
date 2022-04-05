<?php

namespace App\Actions\Custom;

use App\Models\Order;

class CreateOrderAction
{
<<<<<<< HEAD:app/Actions/CreateOrderAction.php
    public function create(int $reference, array $data): Order
=======

    public function create(array $data, ?int $reference): Order
>>>>>>> feature/add-shopping-history:app/Actions/Custom/CreateOrderAction.php
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
