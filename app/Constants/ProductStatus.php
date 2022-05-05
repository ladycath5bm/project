<?php 

namespace App\Constants;

use App\Contracts\ConstantsContract;

class ProductStatus implements ConstantsContract
{
    public CONST ENABLED = 'ENABLED';
    public CONST DISABLED = 'DISABLED';

    public static function toArray(): array
    {
        return [
            self::ENABLED,
            self::DISABLED,
        ];
    }
}
