<?php

namespace Database\Factories\Government;

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
    public function definition()
    {
        return [
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(5),
            "img_link" => fake()->sentence(),
            "comments" => json_encode([
                [
                    "author" => fake()->name(),
                    "avatar" => fake()->image(),
                    "comment" => fake()->sentence(),
                    "created_at" => fake()->dateTime(),
                ],
                [
                    "author" => fake()->name(),
                    "avatar" => fake()->image(),
                    "comment" => fake()->sentence(),
                    "created_at" => fake()->dateTime(),
                ],
            ]),
        ];
    }
}
