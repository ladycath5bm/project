<?php

return [
    'gateways' => [
        'placetopay' => [
            'login' => env('PLACETOPAY_LOGIN'),
            'key' => env('PLACETOPAY_TRAN_KEY'),
            'url' => env('PLACETOPAY_URL'),
        ],
        'paypal' => [
            'key' => env('PAYPAL_SECRET_KEY'),
        ],
    ],
];
