<?php

namespace App\Constants;

class TransactionType
{
    public const NONE = 0;

    public const IN = 1;

    public const OUT = 2;

    public static function getLabel($value): string
    {
        return match ($value) {
            self::IN => "IN",
            self::OUT => "OUT",
            default => "None",
        };
    }
}
