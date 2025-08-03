<?php

namespace Database\Factories;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'partner_code' => 'BUMR-' . fake()->unique()->numerify('####'),
            'organization_name' => fake()->company() . ' Rice Farm',
            'contact_person' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'region' => fake()->randomElement(['Region I', 'Region II', 'Region III', 'Region IV-A', 'Region V']),
            'status' => fake()->randomElement(['active', 'inactive', 'pending']),
            'certification_documents' => [
                'business_permit' => fake()->url(),
                'tax_clearance' => fake()->url(),
            ],
            'total_investment' => fake()->randomFloat(2, 50000, 500000),
            'total_returns' => fake()->randomFloat(2, 0, 300000),
        ];
    }

    /**
     * Indicate that the partner is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}