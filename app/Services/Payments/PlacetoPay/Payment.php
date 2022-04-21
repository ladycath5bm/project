<?php

namespace App\Services\Payments\PlacetoPay;

use App\Constants\Currencies;
use App\Models\Order;

class Payment
{
    public static function make(Order $order): array
    {
        return [
            'reference' => $order->reference,
            'description' => trans('payment.description'),
            'amount' => [
                'currency' => Currencies::COP,
                'total' => $order->total,
                ],
            'allowPartial' => false,
        ];
    }
}
