<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $table = 'rewards';

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'total_rewards',
        'claimed_rewards',
        'is_available',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'type' => 'double',
        'amount' => 'double',
        'total_rewards' => 'integer',
        'claimed_rewards' => 'integer',
        'is_available' => 'integer',
    ];
}
