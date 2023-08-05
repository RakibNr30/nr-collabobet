<?php

namespace App\Constants;

class TransactionStatus
{
    public const PENDING = 0;

    public const ACCEPTED = 1;

    public const DECLINED = 2;

    public static function getLabel($value): string
    {
        return match ($value) {
            self::PENDING => "Pending",
            self::ACCEPTED => "Accepted",
            self::DECLINED => "Declined",
            default => "None",
        };
    }
}
