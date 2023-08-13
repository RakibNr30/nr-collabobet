<?php


namespace App\Helpers;


class UrlHelper
{
    public static function isMatch($path): bool
    {
        return str_contains(request()->path(), $path);
    }
}
