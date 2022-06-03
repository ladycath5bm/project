<?php

namespace App\Actions\Custom;

use App\Constants\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Services\Payments\PlacetoPay\PlacetoPay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReversePaymentAction
{
    public function reverse(order $order): void
    {
        $response = PlacetoPay::reversePayment(json_decode($order->transactions)[0]->internalReference);

        if ($response->ok()) {
            
            DB::transaction(function () use ($order) {
                $this->updateStatus($order);
            }); 
        }
    }

    private function updateStatus(Order $order): void
    {
        $order->status = OrderStatus::REJECTED;
        $this->updateOrderReverse($order);
        $order->save();
    }

    private function updateOrderReverse(Order $order): void
    {
        foreach ($order->products as $product) {
            Product::find($product->id)->increment('stock', $product->pivot->quantity);
            Log::info('Se ha actualizado el stock de un producto en una orden reversada', [
                'product_id' => $product->getKey(),
            ]);
        }
    }
}
