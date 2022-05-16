<?php

namespace App\Actions\Custom;

use App\Models\Order;
use App\Models\Product;
use App\Constants\OrderStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;
use App\Services\Payments\PlacetoPay\PlacetoPay;

class ConsultPaymentStatusAction
{
    public function consult(Order $order): void
    {
        $response = PlacetoPay::getRequestInformation($order->request_id);

        if ($response->ok()) {
            DB::transaction(function () use ($response, $order) {
                $this->updateStatus($response, $order);       
            });
        }
        
    }

    private function updateStatus(Response $response, Order $order): void
    {
        $data = $response->json();
        $responseSesion = $data['status'];
        $responsePayment = $data['payment'] ?? [];

        if (($responseSesion['status'] === OrderStatus::APPROVED) && isset($data['payment'])) {
            $order->status = OrderStatus::APPROVED;
            $order->transactions = $responsePayment;
        } elseif ($responseSesion['status'] === OrderStatus::REJECTED) {
            $order->status = OrderStatus::REJECTED;
            $order->transactions = $responsePayment;

            self::updateOrderRejected($order);
        } else {
            $order->status = OrderStatus::PENDING;
        }

        $order->save();
    }

    public static function updateOrderRejected(Order $order): void
    {
        foreach ($order->products as $product) {
            Product::find($product->id)->increment('stock', $product->pivot->quantity);
            Log::info('Se ha actualizado el stock de un producto en una orden rechazada', [
                'product_id' => $product->getKey(),
            ]);
        }
    }
}
