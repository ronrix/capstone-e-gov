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
        $img_links = [
            "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1",
            "http://tarakahitsaan.com/images/spots/mt-sembrano-rizal.jpg",
            "https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-011.jpg?w=650",
            "https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-016.jpg",
            "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/9060Bulawan_Floating_Restaurant_46.jpg/800px-9060Bulawan_Floating_Restaurant_46.jpg?20190506074310",
        ];

        return [
            "title" => fake()->city(),
            "category" => fake()->catchPhrase(),
            "description" => fake()->paragraph(5),
            "img_link" => fake()->randomElement($img_links),
            "location" => fake()->address(),
        ];
    }
}
