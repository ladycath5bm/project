<?php

namespace App\Constants;

class OrderStatus
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
            self::CREATED
        ];
    }
}
