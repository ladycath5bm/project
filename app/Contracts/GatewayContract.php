<?php

namespace App\Contracts;

use App\Models\Order;
use Illuminate\Http\Client\Response;

interface GatewayContract
{
    public function pay(Order $order): Response;
}
