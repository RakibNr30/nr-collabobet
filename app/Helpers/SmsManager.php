<?php


namespace App\Helpers;


class SmsManager
{
    public static function sendSms($to, $text): bool|string
    {
        $to = str_replace('+', '', $to);
        $apiUrl = config('core.sms_api');
        $apiUrl = str_replace('[TO]', $to, $apiUrl);
        $apiUrl = str_replace('[TEXT]', urlencode($text), $apiUrl);

        return file_get_contents($apiUrl);
    }

    public static function isSendAble(): bool
    {
        return config('core.sms_login_info');
    }
}
