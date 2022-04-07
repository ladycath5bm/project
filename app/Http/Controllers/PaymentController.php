<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Payments\GatewayFactory;
use App\Services\Payments\PlacetoPay\PlacetoPay;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Request $request): RedirectResponse
    {
        $gateway = GatewayFactory::make('placetopay');
        $response = $gateway->pay($request);

        return redirect()->to($response['processUrl']);
    }

    public static function consult(int $id)
    {
        $order = Order::select('id', 'status', 'requestId', 'transactions', 'created_at', 'customerName', 'customerEmail', 'reference')
            ->where('customer_id', auth()->user()->id)
            ->first();

        $response = PlacetoPay::getRequestInformation($order->requestId);
        $responsePayment = $response->json()['payment'];

        if ($response->successful()) {
            //$responseSesion = $response->json()['status'];    
            $responseTransaction = $responsePayment[0]['status'];
            $order->status = $responseTransaction['status'];
            $message = $responseTransaction['message'];
            $order->transactions = $responsePayment;
        } else {
            $responseTransaction = $responsePayment[0]['status'];
            $message = $responseTransaction['message'];
        }

        $order->save();
        return view('consult', compact('order', 'message'));
    }

    public function retray(int $id)
    {
        $order = Order::where('id', $id)->first();
        return redirect()->to($order->processUrl);
    }
}
