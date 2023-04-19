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
        $img_links = [
            "https://fab.ph/wp-content/uploads/2019/03/8cSDwpg0d9YbVTRxUqrM1.png",
        ];

        return [
            "title" => fake()->company(),
            "authors" => fake()->name(),
            "description" => fake()->paragraph(5),
            "category" => fake()->catchPhrase(),
            "location" => fake()->address(),
            "img_link" => fake()->randomElement($img_links),
        ];
    }
}
