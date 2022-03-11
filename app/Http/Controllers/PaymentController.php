<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\Payments\GatewayFactory;
use App\Services\Payments\PlacetoPay\PlacetoPay;

class PaymentController extends Controller
{
    public function pay(Request $request): RedirectResponse
    {
        $gateway = GatewayFactory::make('placetopay');
        $response = $gateway->pay($request);
        //dd($response);

        return redirect()->to($response['processUrl']);
    }

    public function consult()
    {
        //dd($this->requestId);
        $order = Order::latest()->first();
        //dd($order->first());
        $response = PlacetoPay::getRequestInformation($order->reference);
        $order->status = $response['status']['status'];
        return view('consult', compact('order'));
    }
}
