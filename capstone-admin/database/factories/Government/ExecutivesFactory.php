<?php

namespace Database\Factories\Government;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Executives>
 */
class ExecutivesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {    
        $img_links = [
            "https://www.aljazeera.com/wp-content/uploads/2021/11/2021-11-25T031337Z_760729068_RC2A1R99GGKE_RTRMADP_3_HAITI-POLITICS.jpg?resize=770%2C513&quality=80",
            "https://www.rappler.com/tachyon/r3-assets/CE61EDC2F57C4F11AC422DFB50276C10/img/D3ECB8B642294967A7EC984DDF7F2F09/juan-ponce-enrile-coc-filing-october-17-2018-001.jpg",
            "https://sa.kapamilya.com/absnews/abscbnnews/media/2020/news/07/15/20200626-asean-duterte-mnib.jpg",
        ];
        $positions = [
            "mayor",
            "vice mayor",
            "barangay official",
            "agriculture",
            "hr",
            "treasurer",
        ];

        return [
            "executive_name" => fake()->userName(),
            "position" => fake()->randomElement($positions),
            "img_link" => fake()->randomElement($img_links),
            "start_term" => fake()->dateTime(),
            "end_term" => fake()->dateTime(),
        ];
    }
}
