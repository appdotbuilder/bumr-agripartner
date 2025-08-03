<?php

namespace Database\Factories;

use App\Models\Partner;
use App\Models\RiceField;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RiceField>
 */
class RiceFieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $plantingDate = fake()->dateTimeBetween('-6 months', 'now');
        
        return [
            'partner_id' => Partner::factory(),
            'field_name' => 'Field ' . fake()->randomElement(['A', 'B', 'C', 'D']) . '-' . fake()->numberBetween(1, 20),
            'location' => fake()->city() . ', ' . fake()->randomElement(['Luzon', 'Visayas', 'Mindanao']),
            'latitude' => fake()->latitude(14.0, 18.0), // Philippines latitude range
            'longitude' => fake()->longitude(120.0, 126.0), // Philippines longitude range
            'area_hectares' => fake()->randomFloat(2, 0.5, 10.0),
            'rice_variety' => fake()->randomElement(['IR64', 'PSB Rc82', 'NSIC Rc222', 'NSIC Rc160', 'PSB Rc18']),
            'planting_date' => $plantingDate,
            'expected_harvest_date' => (clone $plantingDate)->modify('+120 days'),
            'status' => fake()->randomElement(['planted', 'growing', 'mature', 'harvested']),
            'expected_yield_tons' => fake()->randomFloat(2, 2.0, 8.0),
            'actual_yield_tons' => fake()->optional(0.6)->randomFloat(2, 1.5, 8.5),
            'weather_conditions' => [
                'temperature' => fake()->numberBetween(25, 35),
                'humidity' => fake()->numberBetween(60, 90),
                'rainfall' => fake()->numberBetween(0, 50),
            ],
            'notes' => fake()->optional()->sentence(),
        ];
    }
}