<?php 

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

interface GatewayContract
{
    public function pay(): array;
}