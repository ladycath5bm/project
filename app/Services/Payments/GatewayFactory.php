<?php

namespace App\Services\Payments;

use App\Contracts\GatewayContract;
use App\Services\Payments\PayPal\PayPal;
use App\Services\Payments\PlacetoPay\PlacetoPay;
use InvalidArgumentException;

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
                return new PlacetoPay();
        }
    }
}
