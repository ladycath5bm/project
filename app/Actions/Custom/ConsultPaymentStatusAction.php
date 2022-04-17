<?php

namespace App\Actions\Custom;

use App\Models\Order;
use App\Models\Product;
use App\Constants\OrderStatus;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;
use App\Services\Payments\PlacetoPay\PlacetoPay;

class ConsultPaymentStatusAction
{
    public function consult(Order $order): Order
    {
        
        $response = PlacetoPay::getRequestInformation($order->requestId);
        $order = $this->updateStatus($response, $order);

        if ($order->status == OrderStatus::REJECTED) {
            $order = self::updateOrderRejected($order);
        }

        return $order;
    }

    private function updateStatus(Response $response, Order $order): Order
    {
        if ($response->successful()) {
            
            $responseSesion = $response->json()['status'];
            
            if ($responseSesion['status'] != 'REJECTED') {

                if ($response->json()['payment'] != null) {

                    $responsePayment = $response->json()['payment'];
                    $responseTransaction = $responsePayment[0]['status'];
                    $order->status = $responseTransaction['status'];
                    $message = $responseTransaction['message'];
                    $order->transactions = $responsePayment;
                }
            } else {
                $order->status = $responseSesion['status'];
                $message = $responseSesion['message'];
            }

        } else {
            $responseSesion = $response->json()['status'];
            $message = $responseSesion['message'];
        }
        //dd($order);
        $order->save();
        return $order;
    }

    public static function updateOrderRejected(Order $order): Order
    {
        foreach ($order->products as $product) {
            Product::find($product->id)->increment('stock', $product->pivot->quantity);
            Log::info(['message, se ha actualizado un producto'], [
                'product_id' => $product->getKey(),
            ]);
        }

        return $order;
    }
}
