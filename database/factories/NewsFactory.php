<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Mengaitkan dengan user
            'title' => fake()->sentence(),
            'image' => fake()->imageUrl(),
            'body' => fake()->paragraph(),
            'status' => fake()->randomElement(['published', 'review','rejected']),
        ];
    }

}