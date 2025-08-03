<?php

namespace Database\Factories;

use App\Models\FieldUpdate;
use App\Models\RiceField;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FieldUpdate>
 */
class FieldUpdateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $updateType = fake()->randomElement(['photo', 'video', 'inspection', 'weather', 'pest_disease', 'fertilizer', 'irrigation']);
        
        return [
            'rice_field_id' => RiceField::factory(),
            'user_id' => User::factory(),
            'update_type' => $updateType,
            'description' => $this->getDescriptionForType($updateType),
            'media_urls' => $updateType === 'photo' || $updateType === 'video' ? [
                fake()->imageUrl(800, 600, 'agriculture'),
                fake()->imageUrl(800, 600, 'rice'),
            ] : null,
            'weather_data' => $updateType === 'weather' ? [
                'temperature' => fake()->numberBetween(25, 35),
                'humidity' => fake()->numberBetween(60, 90),
                'rainfall' => fake()->numberBetween(0, 50),
                'wind_speed' => fake()->numberBetween(5, 25),
            ] : null,
            'growth_metrics' => fake()->randomElement([null, [
                'plant_height' => fake()->numberBetween(20, 120),
                'tiller_count' => fake()->numberBetween(5, 25),
                'leaf_color' => fake()->randomElement(['light_green', 'green', 'dark_green']),
            ]]),
            'health_status' => fake()->randomElement(['excellent', 'good', 'fair', 'poor', 'critical']),
            'recommendations' => fake()->optional()->sentence(),
        ];
    }

    /**
     * Get a description based on the update type.
     */
    protected function getDescriptionForType(string $type): string
    {
        return match ($type) {
            'photo' => 'Field photo update showing current crop condition',
            'video' => 'Video documentation of field progress',
            'inspection' => fake()->randomElement([
                'Weekly field inspection completed',
                'Growth stage assessment conducted',
                'Quality check performed',
            ]),
            'weather' => 'Weather conditions recorded',
            'pest_disease' => fake()->randomElement([
                'Minor pest activity observed',
                'Disease prevention measures applied',
                'Healthy crop condition maintained',
            ]),
            'fertilizer' => fake()->randomElement([
                'Fertilizer application completed',
                'Organic nutrients added',
                'Soil conditioning performed',
            ]),
            'irrigation' => fake()->randomElement([
                'Irrigation system checked',
                'Water levels adjusted',
                'Drainage maintained',
            ]),
            default => 'Field update recorded',
        };
    }
}