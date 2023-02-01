<?php

namespace Database\Factories\Government;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotlines>
 */
class HotlinesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "department" => fake()->company(),
            "first_number" => fake()->phoneNumber(),
            "second_number" => fake()->phoneNumber(),
        ];
    }
}
