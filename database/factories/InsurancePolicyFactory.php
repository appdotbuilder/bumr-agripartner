<?php

namespace Database\Factories;

use App\Models\InsurancePolicy;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InsurancePolicy>
 */
class InsurancePolicyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-1 year', 'now');
        $endDate = (clone $startDate)->modify('+1 year');
        
        return [
            'partner_id' => Partner::factory(),
            'policy_number' => 'INS-' . fake()->unique()->numerify('########'),
            'insurance_provider' => fake()->randomElement([
                'Philippine Crop Insurance Corporation',
                'RCBC Insurance',
                'Malayan Insurance',
                'Pioneer Insurance',
            ]),
            'policy_type' => fake()->randomElement(['crop', 'weather', 'multi_peril', 'revenue']),
            'coverage_amount' => fake()->randomFloat(2, 50000, 500000),
            'premium_amount' => fake()->randomFloat(2, 2000, 25000),
            'policy_start_date' => $startDate,
            'policy_end_date' => $endDate,
            'status' => fake()->randomElement(['active', 'expired', 'claimed', 'cancelled']),
            'coverage_details' => [
                'natural_disasters' => true,
                'pest_damage' => true,
                'weather_related' => true,
                'fire' => fake()->boolean(),
            ],
            'risk_factors' => [
                'flood_risk' => fake()->randomElement(['low', 'medium', 'high']),
                'drought_risk' => fake()->randomElement(['low', 'medium', 'high']),
                'pest_risk' => fake()->randomElement(['low', 'medium', 'high']),
            ],
            'terms_conditions' => fake()->paragraphs(3, true),
        ];
    }
}