<?php

namespace App\Constants;

use App\Contracts\ConstantsContract;

class Currencies implements ConstantsContract
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
