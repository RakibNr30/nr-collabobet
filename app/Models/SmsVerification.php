<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsVerification extends Model
{
    use HasFactory;

    protected $table = 'sms_verifications';

    protected $fillable = [
        'mobile',
        'refer_affiliate_code',
        'code',
        'expired_at',
        'verification_id',
        'is_verified',
    ];

    protected $casts = [
        'mobile' => 'string',
        'refer_affiliate_code' => 'string',
        'code' => 'integer',
        'expired_at' => 'timestamp',
        'verification_id' => 'string',
        'is_verified' => 'integer',
    ];
}
