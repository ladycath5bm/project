<?php

namespace App\Actions\Custom;

use App\Models\Order;

class UpdateOrderAction
{
    public function update(Order $order, array $payment, string $requestId, string $processUrl): Order
    {
        $order->description = $payment['description'];
        $order->request_id = $requestId;
        $order->process_url = $processUrl;
        $order->save();

        return $order;
    }
}
