<?php

namespace App\Http\Controllers;

use App\Constants\OrderStatus;
use App\Models\Order;
use App\Services\Payments\GatewayFactory;
use App\Services\Payments\PlacetoPay\PlacetoPay;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Order $order): RedirectResponse
    {
        $gateway = GatewayFactory::make('placetopay');
        $response = $gateway->pay($order);

        return redirect()->to($response['processUrl']);
    }

    public function consult(int $id)
    {
        $order = Order::select('id', 'status', 'requestId', 'processUrl', 'transactions', 'created_at', 'customerName', 'customerEmail', 'reference')
            ->where('id', $id)
            ->where('customer_id', auth()->user()->id)
            ->first();

        $response = PlacetoPay::getRequestInformation($order->requestId);

        if ($response->successful()) {
            $responseSesion = $response->json()['status'];
       
            if ($responseSesion['status'] != 'REJECTED') {
                $responsePayment = $response->json()['payment'];
                $responseTransaction = $responsePayment[0]['status'];
                $order->status = $responseTransaction['status'];
                $message = $responseTransaction['message'];
                $order->transactions = $responsePayment;
            } else {
                $order->status = $responseSesion['status'];
                $message = $responseSesion['message'];
            }
        } else {
            //dd($response->json());
            $responseTransaction = $response->json()['status'];
            $message = $responseTransaction['message'];
        }

        $order->save();
        return view('consult', compact('order', 'message'));
    }

    public function retray(int $id): RedirectResponse
    {
        $order = Order::where('id', $id)->first();
        return redirect()->to($order->processUrl);
    }

    public function cancel(Order $order): RedirectResponse
    {
        $orderCancel = Order::select('id', 'status')
            ->where('id', $order->id)->first();
        $orderCancel->status = OrderStatus::REJECTED;
        $orderCancel->save();

        return redirect()->route('orders.index');
    }
}
