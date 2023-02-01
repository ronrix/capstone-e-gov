<?php

namespace Database\Factories\Government;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Population>
 */
class PopulationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "barangays" => fake()->streetName(),
            "census_year" => fake()->year(),
            "female" => fake()->randomDigit(),
            "male" => fake()->randomDigit(),
            "total_population" => fake()->randomDigit(),
            "household" => fake()->randomDigit(),
            "religion" => fake()->name()
        ];
    }
}
