<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(string $gateway): RedirectResponse
    {
        $gateway = GatewayFactory::make($gateway);
        $response = $gateway->pay();

        return redirect()->to($response['proccessUrl']);
    }
}
