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
        $img_links = [
            "https://cdn.dribbble.com/users/2089694/screenshots/15254872/media/72cb5ad92a61d36de040a5a7433a2e07.png?compress=1&resize=700x525&vertical=top",
            "https://cdn.dribbble.com/users/2089694/screenshots/15254872/media/72cb5ad92a61d36de040a5a7433a2e07.png?compress=1&resize=700x525&vertical=top",
            "https://i.natgeofe.com/n/959eb04a-010b-48d7-8a51-1711d781d6d1/diwali-lanterns-rts2t3o5.jpg",
            "https://c.files.bbci.co.uk/2E51/production/_128875811_holiepa.jpg",
        ];
        return [
            "title" => fake()->firstName(),
            "authors" => fake()->firstName(),
            "description" => fake()->paragraph(5),
            "img_link" => fake()->randomElement($img_links),
        ];
    }
}
