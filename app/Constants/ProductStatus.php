<?php

namespace App\Constants;

use App\Contracts\ConstantsContract;

class ProductStatus implements ConstantsContract
{
    public const ENABLED = 'ENABLED';
    public const DISABLED = 'DISABLED';

    public static function toArray(): array
    {
        return [
            self::ENABLED,
            self::DISABLED,
        ];
    }
}
