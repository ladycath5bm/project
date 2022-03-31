<?php

namespace App\Services\Payments\PayPal;

use App\Contracts\GatewayContract;

class PayPal implements GatewayContract
{
    private string $key;

    public function __construct()
    {
        //leer configuración de pasarela de pagos
        $this->key = config('payments.gateways.paypal.key');
    }

    public function pay(): array
    {
        return ["Estamos pagandpo usando paypal Key: {$this->key}"];
    }
}
