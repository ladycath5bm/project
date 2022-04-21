<?php

namespace App\Contracts;

use App\Models\Order;

interface GatewayContract
{
    public function pay(Order $order): array;
}
