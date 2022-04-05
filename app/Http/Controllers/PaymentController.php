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
        //dd($response);

        return redirect()->to($response['processUrl']);
    }

    public static function consult(int $id)
    {
        $order = Order::where('id', $id)->first();
        $response = PlacetoPay::getRequestInformation($order->requestId);
        //dd($response->json()['payment']);
        if ($response->successful()) {
            //dd($response->json()['status']);
            $responseSesion = $response->json()['status'];
            $responseTransaction = $response->json()['payment'][0]['status'];
            $order->status = $responseTransaction['status'];
            $message = $responseTransaction['message'];
            $order->transactions = $response->json()['payment'];
            //$order->save();
        } else {
            $responseTransaction = $response->json()['payment'][0]['status'];
            $message = $responseTransaction['message'];
        }
        //dd($order->status);
        $order->save();
        //echo 'holi, no mueriendo en el intento #6';
        return view('consult', compact('order', 'message'));
    }

    public function retray(int $id)
    {
        //dd($order);
        $order = Order::where('id', $id)->first();

        //dd($order);
        return redirect()->to($order->processUrl);
    }
}
