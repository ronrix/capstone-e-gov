<?php

namespace Database\Factories\Government;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Executives>
 */
class ExecutivesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "executive_name" => fake()->userName(),
            "position" => fake()->jobTitle(),
            "img_link" => fake()->image(),
            "member" => false,
            "start_term" => fake()->dateTime(),
            "end_term" => fake()->dateTime(),
        ];
    }
}
