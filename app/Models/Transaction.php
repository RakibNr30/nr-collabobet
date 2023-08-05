<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'type',
        'balance_id',
        'amount',
        'account_owner',
        'blz',
        'iban',
        'annotation',
        'uuid',
        'user_id',
        'status',
        'actioned_at',
    ];

    protected $casts = [
        'type' => 'integer',
        'balance_id' => 'integer',
        'amount' => 'double',
        'account_owner' => 'string',
        'blz' => 'string',
        'iban' => 'string',
        'annotation' => 'string',
        'uuid' => 'string',
        'user_id' => 'integer',
        'status' => 'integer',
        'actioned_at' => 'timestamp',
    ];
}
