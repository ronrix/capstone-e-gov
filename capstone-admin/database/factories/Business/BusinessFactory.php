<?php

namespace Database\Factories\Business;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "business_name" => fake()->company(),
            "business_type" => fake()->jobTitle(),
            "established_date" => fake()->postcode(),
        ];
    }
}
