<?php

namespace App\Constants;

class RewardType
{
    public const NONE = 0;

    public const PARTICIPANT = 1;

    public const RECOMMENDATION = 2;

    public const BENEFACTOR = 3;

    public const GENIUS = 4;

    public static function getLabel($value): string
    {
        return match ($value) {
            self::PARTICIPANT => "Participant",
            self::RECOMMENDATION => "Recommendation",
            self::BENEFACTOR => "Benefactor",
            self::GENIUS => "Genius",
            default => "None",
        };
    }

    public static function getAmount($value): string
    {
        return match ($value) {
            self::PARTICIPANT => 400,
            self::RECOMMENDATION => 200,
            self::BENEFACTOR => 100,
            self::GENIUS => 500,
            default => 0,
        };
    }

    public static function getMax($value): string
    {
        return match ($value) {
            self::PARTICIPANT => 1,
            self::RECOMMENDATION => INF,
            self::BENEFACTOR => 3,
            self::GENIUS => 50,
            default => 0,
        };
    }
}
