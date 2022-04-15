<?php

namespace App\Actions\Custom;

use App\Models\Order;

class UpdateOrderAction
{
    public function update(Order $order, array $payment, string $requestId, string $processUrl): Order
    {
        $order->description = $payment['description'];
        $order->requestId = $requestId;
        $order->processUrl = $processUrl;
        $order->save();

        return $order;
    }
}
