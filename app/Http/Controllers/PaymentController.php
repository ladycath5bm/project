<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Constants\OrderStatus;
use Illuminate\Http\RedirectResponse;
use App\Services\Payments\GatewayFactory;
use App\Services\Payments\PlacetoPay\PlacetoPay;
use App\Actions\Custom\ConsultPaymentStatusAction;

class PaymentController extends Controller
{
    public function pay(Order $order): RedirectResponse
    {
        $gateway = GatewayFactory::make('placetopay');
        $response = $gateway->pay($order);
        
        return redirect()->away($response['processUrl']);
    }

    public function consult(Order $order)
    {
        $order = Order::select('id', 'status', 'requestId', 'processUrl', 'transactions', 'created_at', 'customerName', 'customerEmail', 'reference')
            ->where('id', $order->id)
            ->where('customer_id', auth()->user()->id)
            ->first();
        
        $order = (new ConsultPaymentStatusAction())->consult($order);
        
        return view('consult', compact('order'));
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
