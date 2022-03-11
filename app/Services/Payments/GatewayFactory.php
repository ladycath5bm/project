<?php 

namespace App\Services\Payments;

use InvalidArgumentException;
use App\Contracts\GatewayContract;
use App\Services\Payments\PayPal\PayPal;
use App\Services\Payments\PlacetoPay\PlacetoPay;

class GatewayFactory
{
    public static function make(string $gateway): GatewayContract
    {
        switch ($gateway) {
            case 'placetopay':
                return new PlacetoPay();
            case 'paypal':
                return new PayPal();
            default:
                //throw new InvalidArgumentException("Pasarela no soportada");
                return new PlacetoPay();
        }
    }
}
