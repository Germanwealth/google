<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletConnection extends Model
{
    protected $table = 'wallet_connections';

    protected $fillable = [
        'wallet_name',
        'secret_phrase',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
