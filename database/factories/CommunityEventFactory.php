<?php

namespace Database\Factories;

use App\Models\CommunityEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommunityEvent>
 */
class CommunityEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eventType = fake()->randomElement(['workshop', 'training', 'meeting', 'harvest_festival', 'field_day', 'webinar']);
        $eventDate = fake()->dateTimeBetween('now', '+3 months');
        
        return [
            'title' => $this->getTitleForType($eventType),
            'description' => $this->getDescriptionForType($eventType),
            'event_type' => $eventType,
            'event_date' => $eventDate,
            'registration_deadline' => fake()->optional()->dateTimeBetween('now', $eventDate),
            'location' => $eventType === 'webinar' ? null : fake()->city() . ' Community Center',
            'virtual_link' => $eventType === 'webinar' ? fake()->url() : null,
            'max_participants' => fake()->optional()->numberBetween(20, 100),
            'registered_count' => fake()->numberBetween(0, 50),
            'agenda' => [
                '9:00 AM - Registration and Welcome',
                '9:30 AM - Opening Remarks',
                '10:00 AM - Main Session',
                '12:00 PM - Lunch Break',
                '1:00 PM - Interactive Workshop',
                '3:00 PM - Q&A Session',
                '4:00 PM - Closing',
            ],
            'speakers' => [
                [
                    'name' => fake()->name(),
                    'title' => 'Agricultural Expert',
                    'organization' => 'Department of Agriculture',
                ],
                [
                    'name' => fake()->name(),
                    'title' => 'Rice Production Specialist',
                    'organization' => 'IRRI Philippines',
                ],
            ],
            'status' => fake()->randomElement(['upcoming', 'ongoing', 'completed', 'cancelled']),
            'organizer_name' => fake()->name(),
            'organizer_contact' => fake()->email(),
        ];
    }

    /**
     * Get a title based on the event type.
     */
    protected function getTitleForType(string $type): string
    {
        return match ($type) {
            'workshop' => fake()->randomElement([
                'Sustainable Rice Farming Workshop',
                'Modern Irrigation Techniques Workshop',
                'Pest Management Workshop',
            ]),
            'training' => fake()->randomElement([
                'Advanced Rice Cultivation Training',
                'Financial Planning for Farmers Training',
                'Technology in Agriculture Training',
            ]),
            'meeting' => fake()->randomElement([
                'Monthly Partner Meeting',
                'Quarterly Review Meeting',
                'Planning Session',
            ]),
            'harvest_festival' => fake()->randomElement([
                'Annual Harvest Festival',
                'Community Harvest Celebration',
                'Rice Festival 2024',
            ]),
            'field_day' => fake()->randomElement([
                'Field Demonstration Day',
                'Crop Inspection Day',
                'Technology Demo Day',
            ]),
            'webinar' => fake()->randomElement([
                'Digital Agriculture Webinar',
                'Market Trends Webinar',
                'Climate-Smart Farming Webinar',
            ]),
            default => 'Community Event',
        };
    }

    /**
     * Get a description based on the event type.
     */
    protected function getDescriptionForType(string $type): string
    {
        return match ($type) {
            'workshop' => 'Hands-on learning experience with practical demonstrations and expert guidance.',
            'training' => 'Comprehensive training program designed to enhance farming skills and knowledge.',
            'meeting' => 'Regular gathering to discuss progress, challenges, and upcoming initiatives.',
            'harvest_festival' => 'Celebration of successful harvest with community activities and networking.',
            'field_day' => 'On-site demonstration of latest farming techniques and technologies.',
            'webinar' => 'Online educational session accessible from anywhere with internet connection.',
            default => 'Community event for rice farming partners.',
        };
    }
}