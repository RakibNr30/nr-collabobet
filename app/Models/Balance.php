<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $table = 'balances';

    protected $fillable = [
        'amount',
        'uuid',
        'user_id',
    ];

    protected $casts = [
        'amount' => 'double',
        'uuid' => 'string',
        'user_id' => 'integer',
    ];
}
