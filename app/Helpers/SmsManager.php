<?php


namespace App\Helpers;


use Twilio\Rest\Client;

class SmsManager
{
    public static function sendSms($to, $text): bool|string
    {
        $country_code = config('core.country_code');

        if (!str_starts_with($to, $country_code)) {
            $to = $country_code . $to;
        }

        return self::usingOther($to, $text);
    }

    public static function isSendAble(): bool
    {
        return config('core.sms_login_info');
    }

    private static function usingTwilio($to, $text): void
    {
        $account_sid = config('core.twilio.account_sid');
        $auth_token = config('core.twilio.auth_token');
        $from_twilio_number = config('core.twilio.number');

        try {
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($to, [
                'from' => $from_twilio_number,
                'body' => $text,
            ]);
        } catch (\Exception $exception) {
            logger($exception);
        }
    }

    private static function usingOther($to, $text): bool|string
    {
        $to = str_replace('+', '', $to);
        $apiUrl = config('core.sms_api');
        $apiUrl = str_replace('[TO]', $to, $apiUrl);
        $apiUrl = str_replace('[TEXT]', urlencode($text), $apiUrl);

        return file_get_contents($apiUrl);
    }
}
