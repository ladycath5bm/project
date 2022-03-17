<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\Payments\GatewayFactory;
use Gloudemans\Shoppingcart\Facades\Cart;
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
        $response = PlacetoPay::getRequestInformation($order->requestId);

        if ($response->isSuccessful()) {
            $responseTransaction = $response->status();
            dd($responseTransaction);
            //$orderRepository->updateStatusTransaction($order, $responseTransaction->status());
            $order->status = $responseTransaction->status();
            $message = $responseTransaction->message();
        } else {
            $message = $response->status()->message();
        }

        $order = $orderRepository->find($id);
        return view('order.show', compact('order', 'message'));

        //order->status = $response['payment'][0]['status']['status']);
        $order->status = $response['status']['status'];
        //dd($order->status);

        if ($order->status == 'PENDING') {
            //IR A JOD COMMAND Y SCHEDULING;
            //comando de consulta
            $this->consult();
        }
        return view('consult', compact('order'));
    }
}
