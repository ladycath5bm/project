<?php

namespace App\Services\Payments\PlacetoPay;

use App\Models\Order;

class Buyer
{
    public static function make(Order $order): array
    {
        return [
            'name' => $order->name,
            'document' => $order->document,
            'email' => $order->email,
            'mobile' => $order->mobile,
            'address' => $order->address,
        ];
    }
}
