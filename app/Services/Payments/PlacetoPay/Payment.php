<?php

namespace App\Services\Payments\PlacetoPay;

use App\Constants\Currencies;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;

class Payment
{
    public static function make(Order $order): array
    {
        $subtotal = Cart::subtotal();

        return [
            'reference' => $order->reference,
            'description' => trans('payment.description'),
            'amount' => [
                'currency' => Currencies::COP,
                'total' => $subtotal,
                ],
            'allowPartial' => false,
        ];
    }
}
