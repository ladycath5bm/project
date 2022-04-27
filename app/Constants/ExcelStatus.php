<?php

namespace App\Constants;

class ExcelStatus
{
    public const PROCESSING = 'PROCESSING';
    public const FINISHED = 'FINISHED';
    public const FAILED = 'FAILED';

    public static function toArray(): array
    {
        return [
            self::PROCESSING,
            self::FINISHED,
            self::FAILED,
        ];
    }
}
