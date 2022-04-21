<?php

namespace App\Http\Controllers;

use App\Actions\Custom\ConsultPaymentStatusAction;
use App\Constants\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Services\Payments\GatewayFactory;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function pay(Order $order): RedirectResponse
    {
        $gateway = GatewayFactory::make('placetopay');
        $response = $gateway->pay($order);

        return redirect()->away($response['processUrl']);
    }

    public function retray(Order $order): RedirectResponse
    {
        foreach ($order->products as $product) {
            Product::find($product->id)->decrement('stock', $product->pivot->quantity);
        }

        return $this->pay($order);
    }

    public function cancel(Order $order): RedirectResponse
    {
        $orderCancel = Order::select('id', 'status')
            ->where('id', $order->id)->first();

        $orderCancel->status = OrderStatus::REJECTED;
        $orderCancel->save();

        ConsultPaymentStatusAction::updateOrderRejected($order);

        return redirect()->route('orders.index');
    }
}
