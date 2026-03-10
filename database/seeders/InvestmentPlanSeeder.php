<?php

namespace Database\Seeders;

use App\Models\InvestmentPlan;
use Illuminate\Database\Seeder;

class InvestmentPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Starter Plan',
                'description' => 'Perfect for beginners looking to start their investment journey',
                'minimum_investment' => 100,
                'maximum_investment' => 5000,
                'monthly_return_percentage' => 8.5,
                'duration_months' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Growth Plan',
                'description' => 'Ideal for investors seeking balanced growth and returns',
                'minimum_investment' => 5000,
                'maximum_investment' => 50000,
                'monthly_return_percentage' => 12.5,
                'duration_months' => 24,
                'is_active' => true,
            ],
            [
                'name' => 'Premium Plan',
                'description' => 'For serious investors looking for maximum returns',
                'minimum_investment' => 50000,
                'maximum_investment' => 500000,
                'monthly_return_percentage' => 18.0,
                'duration_months' => 36,
                'is_active' => true,
            ],
            [
                'name' => 'Elite Plan',
                'description' => 'Exclusive plan for institutional and high-value investors',
                'minimum_investment' => 500000,
                'maximum_investment' => null,
                'monthly_return_percentage' => 25.0,
                'duration_months' => 48,
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            InvestmentPlan::create($plan);
        }
    }
}
