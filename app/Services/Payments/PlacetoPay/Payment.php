<?php

namespace App\Services\Payments\PlacetoPay;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;

class Payment
{
    public static function make(int $reference, Collection $items): array
    {
        $subtotal = (int)Cart::subtotal();
        //dd(Cart::subtotal());
        return [
            'reference' => $reference,
            'description' => 'Payment services, your products',
            'amount' => [
                'currency' => 'COP',
                'total' => $subtotal + 100000,
                ],
            'allowPartial' => false,
        ];
    }
}
