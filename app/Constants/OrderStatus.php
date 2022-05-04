<?php

namespace App\Constants;

use App\Contracts\ConstantsContract;

class OrderStatus implements ConstantsContract
{
    public const APPROVED = 'APPROVED';
    public const REJECTED = 'REJECTED';
    public const PENDING = 'PENDING';
    public const CREATED = 'CREATED';

    public static function toArray(): array
    {
        return [
            self::APPROVED,
            self::REJECTED,
            self::PENDING,
            self::CREATED,
        ];
    }
}
