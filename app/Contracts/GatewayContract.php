<?php 

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

interface GatewayContract
{
    public function pay(Request $request): array;
}