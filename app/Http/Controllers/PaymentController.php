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
        //$response = $response->json();

        return redirect()->away($response->json()['processUrl']);
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

    public function complete(string $reference): RedirectResponse
    {
        $order = Order::select('id', 'status', 'requestId', 'processUrl', 'created_at', 'customerName', 'customerEmail', 'reference')
            ->where('reference', $reference)
            ->where('customer_id', auth()->id())
            ->first();
        
        (new ConsultPaymentStatusAction())->consult($order);

        return redirect()->route('orders.show', $order);
    }
}
