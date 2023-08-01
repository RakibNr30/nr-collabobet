<?php

namespace App\Helpers;

use App\Constants\UserType;

class AuthUser
{
    public static function getId(): int
    {
        return auth()->user()->id;
    }

    public static function isAdmin(): bool
    {
        return auth()->user()->user_type == UserType::ADMIN;
    }

    public static function isUser(): bool
    {
        return auth()->user()->user_type == UserType::USER;
    }

    public static function getProfileStatus(): int
    {
        return auth()->user()->profile_status;
    }

    public static function getProfileProgress(): int
    {
        if (auth()->user()->profile_status < 1)
            return 0;

        return round((auth()->user()->profile_status / 3) * 100);
    }

    public static function isVerificationRequested(): bool
    {
        return auth()->user()->is_verification_requested;
    }
}
