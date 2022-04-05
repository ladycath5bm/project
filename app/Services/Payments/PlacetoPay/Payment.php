<?php

namespace App\Services\Payments\PlacetoPay;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;

class Payment
{
    public static function make(int $reference, Collection $items): array
    {
        $subtotal = (int)Cart::subtotal(auth()->user()->id);
        //dd($items);
        return [
            'reference' => $reference,
            'description' => 'Yoour payment for Ecom by webcheckout',
            'amount' => [
                'currency' => 'COP',
                'total' => $subtotal + 100000,
                ],
            'allowPartial' => false,
        ];
    }

}
