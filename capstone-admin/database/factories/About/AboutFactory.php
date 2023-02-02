<?php

namespace Database\Factories\About;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About\About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "mission" => fake()->paragraph(5),
            "vision" => fake()->paragraph(5),
            "history" => fake()->paragraph(5),
            "contacts" => ["email" => fake()->companyEmail(), "facebook" => fake()->link()],
        ];
    }
}
