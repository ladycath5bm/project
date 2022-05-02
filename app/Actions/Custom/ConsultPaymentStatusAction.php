<?php

namespace App\Actions\Custom;

use App\Constants\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Services\Payments\PlacetoPay\PlacetoPay;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class ConsultPaymentStatusAction
{
    public function consult(Order $order): Order
    {
        $response = PlacetoPay::getRequestInformation($order->requestId);
        $orderConsult = $this->updateStatus($response, $order);

        if ($orderConsult->status == $order->status) {
            return $orderConsult;
        }
        
        if ($orderConsult->status == OrderStatus::REJECTED) {
            $order = self::updateOrderRejected($order);
        }
        return $order;
    }

    private function updateStatus(Response $response, Order $order): Order
    {
        $data = $response->json();

        if ($response->successful()) {
            $responseSesion = $data['status'];

            if (($responseSesion['status'] != OrderStatus::REJECTED) && isset($data['payment'])) {
                $responsePayment = $data['payment'];
                $responseTransaction = $responsePayment[0]['status'];
                $order->status = $responseTransaction['status'];
                $order->transactions = $responsePayment;
                $order->save();
            }else {
                $order->status = $responseSesion['status'];
                $order->save();
            }
        } else {
            $responseSesion = $data['status'];
        }
        
        return $order;
    }

    public static function updateOrderRejected(Order $order): Order
    {
        foreach ($order->products as $product) {
            Product::find($product->id)->increment('stock', $product->pivot->quantity);
            Log::info(['Se ha actualizado un producto'], [
                'product_id' => $product->getKey(),
            ]);
        }

        return $order;
    }
}
