<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = fake()->randomElement(['field_update', 'financial', 'insurance', 'event', 'forum', 'system', 'weather_alert']);
        $type = fake()->randomElement(['info', 'warning', 'success', 'error', 'reminder']);
        
        return [
            'user_id' => User::factory(),
            'title' => $this->getTitleForCategory($category),
            'message' => $this->getMessageForCategory($category),
            'type' => $type,
            'category' => $category,
            'data' => $this->getDataForCategory($category),
            'action_url' => fake()->optional()->url(),
            'read_at' => fake()->optional(0.7)->dateTimeBetween('-1 week', 'now'), // 70% chance of being read
            'priority' => fake()->randomElement(['low', 'medium', 'high', 'urgent']),
            'is_broadcast' => fake()->boolean(20), // 20% chance of being broadcast
        ];
    }

    /**
     * Get a title based on the category.
     */
    protected function getTitleForCategory(string $category): string
    {
        return match ($category) {
            'field_update' => fake()->randomElement([
                'New field inspection report',
                'Field photo uploaded',
                'Growth milestone reached',
            ]),
            'financial' => fake()->randomElement([
                'Monthly financial report ready',
                'Payment received',
                'Budget alert',
            ]),
            'insurance' => fake()->randomElement([
                'Insurance policy renewal reminder',
                'Claim status update',
                'Coverage information',
            ]),
            'event' => fake()->randomElement([
                'New community event announced',
                'Event registration reminder',
                'Event starting soon',
            ]),
            'forum' => fake()->randomElement([
                'New reply to your discussion',
                'Your question was answered',
                'Discussion marked as solution',
            ]),
            'system' => fake()->randomElement([
                'System maintenance scheduled',
                'New feature available',
                'Account security update',
            ]),
            'weather_alert' => fake()->randomElement([
                'Severe weather warning',
                'Rain forecast for your area',
                'Drought alert issued',
            ]),
            default => 'System notification',
        };
    }

    /**
     * Get a message based on the category.
     */
    protected function getMessageForCategory(string $category): string
    {
        return match ($category) {
            'field_update' => 'Your field has been inspected and new photos have been uploaded. Check the latest updates on field conditions.',
            'financial' => 'Your monthly financial report is now available. Review your investment returns and expenses.',
            'insurance' => 'Your insurance policy is due for renewal in 30 days. Please review and update your coverage.',
            'event' => 'A new community workshop has been scheduled. Register now to secure your spot.',
            'forum' => 'Someone has replied to your discussion thread. Check out the latest responses and continue the conversation.',
            'system' => 'We have important updates regarding your account. Please review the changes when convenient.',
            'weather_alert' => 'Weather conditions in your area may affect your crops. Take necessary precautions.',
            default => 'You have a new notification.',
        };
    }

    /**
     * Get data based on the category.
     */
    protected function getDataForCategory(string $category): ?array
    {
        return match ($category) {
            'field_update' => [
                'field_id' => fake()->numberBetween(1, 100),
                'update_type' => 'inspection',
                'photos_count' => fake()->numberBetween(1, 5),
            ],
            'financial' => [
                'report_id' => fake()->numberBetween(1, 50),
                'period' => fake()->date('Y-m'),
                'amount' => fake()->randomFloat(2, 1000, 50000),
            ],
            'event' => [
                'event_id' => fake()->numberBetween(1, 20),
                'event_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
                'registration_required' => true,
            ],
            'weather_alert' => [
                'alert_type' => fake()->randomElement(['rain', 'drought', 'storm', 'heat']),
                'severity' => fake()->randomElement(['low', 'medium', 'high']),
                'duration' => fake()->numberBetween(1, 7) . ' days',
            ],
            default => null,
        };
    }
}