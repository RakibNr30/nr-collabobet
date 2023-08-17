<?php
 return [

     'sms_login_info' => true,
     'sms_api' => 'http://api.smsala.com/api/SendSMS?api_id=API1410152086106&api_password=zEP9L43LhB&sms_type=T&encoding=T&sender_id=facebook&phonenumber=[TO]&textmessage=[TEXT]',

     'country_code' => '+1',

     'twilio' => [
         'account_sid' => env('TWILIO_ACCOUNT_SID', 'ACb773abbca585f4921606326619938f57'),
         'auth_token' => env('TWILIO_AUTH_TOKEN', '0e38a11674f7113e12ae2bcecf7cd8ad'),
         'number' => env('TWILIO_NUMBER', '+18583300001'),
     ],

     'media_collection' => [
         'user' => [
             'photo_id_front' => 'photo_id_front_image',
             'photo_id_back' => 'photo_id_back_image',
             'photo_id_selfie' => 'photo_id_selfie_image',
         ],
     ]

 ];
