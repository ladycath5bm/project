<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Constants\OrderStatus;
use Illuminate\Http\RedirectResponse;
use App\Services\Payments\GatewayFactory;
use App\Actions\Custom\ReversePaymentAction;
use App\Actions\Custom\ConsultPaymentStatusAction;

class PaymentController extends Controller
{
    public function pay(Order $order): RedirectResponse
    {
        $gateway = GatewayFactory::make('placetopay');
        $response = $gateway->pay($order);

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
        $order = Order::select('id', 'status', 'request_id', 'process_url', 'created_at', 'customer_name', 'customer_email', 'reference')
            ->where('reference', $reference)
            ->first();

        (new ConsultPaymentStatusAction())->consult($order);

        return redirect()->route('orders.show', $order);
    }

    public function reverse(Order $order)
    {
        $order = Order::select('id', 'status', 'transactions')
            ->where('id', $order->id)
            ->first();

        (new ReversePaymentAction())->reverse($order);

        return redirect()->route('orders.index');

    }
}
