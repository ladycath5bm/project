<?php

namespace App\Services\Payments\PlacetoPay;

use App\Models\Order;

class Buyer
{
    public static function make(Order $order): array
    {
        return [
            'name' => $order->customer_name,
            'document' => $order->customer_document,
            'email' => $order->customer_email,
            'mobile' => $order->customer_phone,
            'address' => $order->customer_address,
        ];
    }
}
