<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\Payments\GatewayFactory;

class PaymentController extends Controller
{
    public function pay(string $gateway): RedirectResponse
    {
        $gateway = GatewayFactory::make($gateway);
        $response = $gateway->pay();

        return redirect()->to($response['proccessUrl']);
    }
}
