<?php

namespace App\Constants;

class ProfileStatus
{
    public const NONE = 0;

    public const ACCOUNT_CREATED = 1;

    public const PERSONAL_DETAILS_CREATED = 2;

    public const VERIFICATION_COMPLETED = 3;

    public static function getLabel($value): string
    {
        return match ($value) {
            self::ACCOUNT_CREATED => "Account Created",
            self::PERSONAL_DETAILS_CREATED => "Personal Details Created",
            self::VERIFICATION_COMPLETED => "Verification Completed",
            default => "None",
        };
    }
}
