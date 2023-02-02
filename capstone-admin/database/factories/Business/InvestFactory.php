<?php

namespace Database\Factories\Business;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business\Invest>
 */
class InvestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "completed_project" => fake()->randomDigit(),
            "on_going_project" => fake()->randomDigit(),
            "description" => fake()->paragraph(5),
        ];
    }
}
