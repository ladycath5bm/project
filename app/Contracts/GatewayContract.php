<?php

namespace App\Contracts;

use App\Models\Order;
use Illuminate\Http\Request;

interface GatewayContract
{
    public function pay(Request $request): array;
}
