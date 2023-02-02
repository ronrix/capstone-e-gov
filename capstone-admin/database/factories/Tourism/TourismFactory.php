<?php

namespace Database\Factories\Tourism;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tourism\Tourism>
 */
class TourismFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "tourist_name" => fake()->city(),
            "tourist_type" => fake()->catchPhrase(),
            "tourist_description" => fake()->paragraph(5),
            "tourist_img_links" => ["link", "link"],
            "tourist_location" => fake()->address(),
        ];
    }
}
