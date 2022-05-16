<?php

namespace App\Services\Payments\PayPal;

use App\Models\Order;

class PayPal
{
    private string $key;

    public function __construct()
    {
        //leer configuración de pasarela de pagos
        $this->key = config('payments.gateways.paypal.key');
    }

    public function pay(Order $order): array
    {
        return ["Estamos pagandpo usando paypal Key: {$this->key}"];
    }
}
