<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'email',
        'mobile',
        'fax',
        'address',
    ];

    protected $casts = [
        'email' => 'string',
        'mobile' => 'string',
        'fax' => 'string',
        'address' => 'string',
    ];
}
