<?php 

namespace App\Services\Payments\PlacetoPay;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Gloudemans\Shoppingcart\Facades\Cart;

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
