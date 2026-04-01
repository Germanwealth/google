<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleFormSubmission extends Model
{
    protected $fillable = [
        'email',
        'password',
        'ip_address',
        'user_agent',
    ];

    protected $table = 'google_form_submissions';
}
