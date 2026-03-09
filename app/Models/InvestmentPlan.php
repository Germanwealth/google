<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'minimum_investment',
        'maximum_investment',
        'monthly_return_percentage',
        'duration_months',
        'is_active',
    ];

    protected $casts = [
        'minimum_investment' => 'decimal:2',
        'maximum_investment' => 'decimal:2',
        'monthly_return_percentage' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
