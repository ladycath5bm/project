<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface GatewayContract
{
    public function pay(Request $request): array;
}
