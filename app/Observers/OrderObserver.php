<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    public function created(Order $order)
    {
        Log::info('Se ha creado una order con refencia:', $this->info($order));
    }

    public function updated(Order $order)
    {
        Log::info(['message, actualiacion de una orden'], [
            'order_id' => $order->getKey(),
        ]);
        if ($order->status == 'APPROVED') {
            Log::info(['message, shopping cart clear'], [
                'order_id' => $order->getKey(),
            ]);
        }
    }
    public function deleted(Order $order)
    {
        Log::warning(['message, se ha borrado una orden'], [
            'order_id' => $order->getKey(),
        ]);
    }

    protected function info(Order $order): array
    {
        return [
            'order_id' => $order->getKey(),
            'user_id' => auth()->id(),
        ];
    }
}
