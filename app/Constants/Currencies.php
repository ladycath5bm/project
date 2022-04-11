<?php

namespace App\Constants;

class Currencies
{
    public const USD = 'USD';
    public const COP = 'COP';

    public static function toArray(): array
    {
        return [
            self::COP,
            self::USD,
        ];
    }
}
