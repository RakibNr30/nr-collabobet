<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $table = 'password_resets';

    protected $fillable = [
        'mobile',
        'token',
    ];

    protected $casts = [
        'mobile' => 'string',
        'token' => 'string',
    ];
}
