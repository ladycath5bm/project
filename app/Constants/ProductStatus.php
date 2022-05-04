<?php 

namespace App\Constants;

use App\Contracts\ConstantsContract;

class ProductStatus implements ConstantsContract
{
    public CONST ENABLE = 'ENABLE';
    public CONST DISABLE = 'DISABLE';

    public static function toArray(): array
    {
        return [
            self::ENABLE,
            self::DISABLE,
        ];
    }
}
