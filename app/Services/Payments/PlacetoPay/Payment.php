<?php

namespace App\Services\Payments\PlacetoPay;

use Gloudemans\Shoppingcart\Facades\Cart;

class Payment
{
    public static function make(int $reference): array
    {
        $subtotal = (int)Cart::subtotal(auth()->user()->id);

        return [
            'reference' => $reference,
            'description' => 'Your payment for Ecom by webcheckout',
            'amount' => [
                'currency' => 'COP',
                'total' => $subtotal,
                ],
            'allowPartial' => false,
        ];
    }
}
