<?php

namespace Database\Factories\About;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About\OfficialSeal>
 */
class OfficialSealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "symbol_logo_img_link" => "https://pilillarizal.gov.ph/wp-content/uploads/2022/12/logo-symbolism-0_1_orig.jpg",
            "logo" => json_encode([
                [
                    "title" => "better pililla",
                    "description" => fake()->paragraph(5),
                    "img_link" => "https://pilillarizal.gov.ph/wp-content/uploads/2022/09/BetterPilillaLogo-1016x400-1-768x302.png"
                ],
                [
                    "title" => "aray ng pililla",
                    "description" => fake()->paragraph(5),
                    "img_link" => "https://pilillarizal.gov.ph/wp-content/uploads/2022/12/araw-ng-pililla-logo-png.png"
                ],
            ])
        ];
    }
}
