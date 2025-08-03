<?php

namespace Database\Factories;

use App\Models\ForumDiscussion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ForumDiscussion>
 */
class ForumDiscussionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = fake()->randomElement(['general', 'technical', 'market_prices', 'weather', 'pest_control', 'equipment', 'finance']);
        
        return [
            'user_id' => User::factory(),
            'title' => $this->getTitleForCategory($category),
            'content' => fake()->paragraphs(3, true),
            'category' => $category,
            'tags' => fake()->randomElements(['rice', 'farming', 'irrigation', 'fertilizer', 'harvest', 'pests', 'weather'], fake()->numberBetween(1, 4)),
            'views_count' => fake()->numberBetween(0, 500),
            'replies_count' => fake()->numberBetween(0, 25),
            'last_activity' => fake()->dateTimeBetween('-1 month', 'now'),
            'is_pinned' => fake()->boolean(10), // 10% chance of being pinned
            'is_locked' => fake()->boolean(5), // 5% chance of being locked
            'status' => fake()->randomElement(['active', 'archived', 'deleted']),
        ];
    }

    /**
     * Get a title based on the category.
     */
    protected function getTitleForCategory(string $category): string
    {
        return match ($category) {
            'general' => fake()->randomElement([
                'Welcome new partners!',
                'Best practices for rice farming',
                'Community guidelines and updates',
            ]),
            'technical' => fake()->randomElement([
                'Optimal planting density for IR64 variety',
                'Soil pH management techniques',
                'Water management during flowering stage',
            ]),
            'market_prices' => fake()->randomElement([
                'Current rice prices in Region III',
                'Market outlook for next quarter',
                'Export opportunities discussion',
            ]),
            'weather' => fake()->randomElement([
                'Preparing for typhoon season',
                'Drought management strategies',
                'Weather forecast impact on harvest',
            ]),
            'pest_control' => fake()->randomElement([
                'Brown planthopper infestation solutions',
                'Organic pest control methods',
                'Early detection of rice diseases',
            ]),
            'equipment' => fake()->randomElement([
                'Recommended irrigation systems',
                'Harvesting equipment maintenance',
                'Cost-effective farming tools',
            ]),
            'finance' => fake()->randomElement([
                'Loan applications for equipment',
                'Budget planning for next season',
                'Insurance claim procedures',
            ]),
            default => 'General discussion topic',
        };
    }
}