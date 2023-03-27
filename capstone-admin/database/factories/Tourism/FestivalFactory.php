<?php

namespace Database\Factories\Tourism;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tourism\Festival>
 */
class FestivalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "festival_name" => fake()->firstName(),
            "festival_description" => fake()->paragraph(5),
            "festival_date" => fake()->date(),
            "festival_img_links" => json_encode(["link", "link"]),
        ];
    }
}
