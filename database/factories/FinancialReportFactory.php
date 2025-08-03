<?php

namespace Database\Factories;

use App\Models\FinancialReport;
use App\Models\Partner;
use App\Models\RiceField;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinancialReport>
 */
class FinancialReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $investment = fake()->randomFloat(2, 10000, 100000);
        $operationalCosts = fake()->randomFloat(2, 5000, 50000);
        $yieldKg = fake()->randomFloat(2, 500, 5000);
        $pricePerKg = fake()->randomFloat(2, 20, 35);
        $revenue = $yieldKg * $pricePerKg;
        $profitLoss = $revenue - $investment - $operationalCosts;
        
        return [
            'partner_id' => Partner::factory(),
            'rice_field_id' => fake()->optional()->randomElement([null, RiceField::factory()]),
            'report_period' => fake()->date('Y-m'),
            'report_type' => fake()->randomElement(['monthly', 'quarterly', 'harvest', 'annual']),
            'investment_amount' => $investment,
            'operational_costs' => $operationalCosts,
            'revenue' => $revenue,
            'profit_loss' => $profitLoss,
            'yield_kg' => $yieldKg,
            'price_per_kg' => $pricePerKg,
            'cost_breakdown' => [
                'seeds' => fake()->randomFloat(2, 2000, 8000),
                'fertilizer' => fake()->randomFloat(2, 3000, 12000),
                'labor' => fake()->randomFloat(2, 5000, 20000),
                'equipment' => fake()->randomFloat(2, 1000, 5000),
                'irrigation' => fake()->randomFloat(2, 1000, 3000),
            ],
            'revenue_breakdown' => [
                'primary_sales' => $revenue * 0.8,
                'secondary_products' => $revenue * 0.2,
            ],
            'notes' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['draft', 'finalized', 'audited']),
        ];
    }
}