<?php

namespace Database\Factories\Business;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business\Permit>
 */
class PermitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $permits = [
            "industry-sepecific requirements",
            "ameding a permit",
            "renewing a permit",
            "other transactions",
        ];
        $requirements = [
            "change of business name" => [
                "application form",
                "updated barangay clearance",
                "original business permit",
                "new picture of logo (if necessary) - not application for single proprietorship",
            ],
            "change of trade name" => [
                "application form",
                "updated barangay clearance",
                "original business permit",
                "new picture of logo (if necessary) - not application for single proprietorship",
            ]
        ];

        return [
            "title" => fake()->randomElement($permits),
            "requirements" => json_encode($requirements),
        ];
    }
}
