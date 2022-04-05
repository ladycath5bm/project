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
        //dd($request);
        $gateway = GatewayFactory::make('placetopay');
        $response = $gateway->pay($request);
        //dd($response);

        return redirect()->to($response['processUrl']);
    }

    public static function consult()//Order $order)
    {
        $order = Order::latest()->first();
        //dd($order);
        $response = PlacetoPay::getRequestInformation($order->requestId);
        //dd($response->json()['payment']);
        if ($response->successful()) {
            //$responseTransaction = $response->status();
            //dd($response->json()['status']);
            $responseSesion = $response->json()['status'];
            $responseTransaction = $response->json()['payment'][0]['status'];
            //$response->
            $order->status = $responseTransaction['status'];
            //dd($response->json()['payment'][0]['status']['status']);
            $message = $responseTransaction['message'];
            $order->transactions = $response->json()['payment'];
            //$order->save();
        } else {
            $responseTransaction = $response->json()['payment'][0]['status'];
            $message = $responseTransaction['message'];
        }

        //order->status = $response['payment'][0]['status']['status']);
        //$order->status = $responseTransaction['status'];
        //dd($order->status);
        $order->save();
        //echo 'holi, no mueriendo en el intento #6';
        //dd($order);
        return view('consult', compact('order', 'message'));
    }

    public function retray(Order $order)
    {
        dd($order);
    }
}
