<?php

namespace Database\Factories;

use App\Models\ForumDiscussion;
use App\Models\ForumReply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ForumReply>
 */
class ForumReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'forum_discussion_id' => ForumDiscussion::factory(),
            'user_id' => User::factory(),
            'parent_reply_id' => null,
            'content' => fake()->paragraphs(2, true),
            'attachments' => fake()->optional()->randomElements([
                'document.pdf',
                'image.jpg',
                'spreadsheet.xlsx',
            ], fake()->numberBetween(1, 2)),
            'is_solution' => fake()->boolean(10), // 10% chance of being marked as solution
            'likes_count' => fake()->numberBetween(0, 25),
            'status' => fake()->randomElement(['active', 'edited', 'deleted']),
        ];
    }
}