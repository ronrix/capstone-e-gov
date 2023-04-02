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

        $religions = [
            [
                ["religion" => "roman catholic", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "aglipay", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "iglesia ni cristo", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "islam", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "others", "count" => fake()->numberBetween(10000, 11000)],
            ],
            [
                ["religion" => "roman catholic", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "aglipay", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "iglesia ni cristo", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "islam", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "others", "count" => fake()->numberBetween(10000, 11000)],
            ],
            [
                ["religion" => "roman catholic", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "aglipay", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "iglesia ni cristo", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "islam", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "others", "count" => fake()->numberBetween(10000, 11000)],
            ],
            [
                ["religion" => "roman catholic", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "aglipay", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "iglesia ni cristo", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "islam", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "others", "count" => fake()->numberBetween(10000, 11000)],
            ],
            [
                ["religion" => "roman catholic", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "aglipay", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "iglesia ni cristo", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "islam", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "others", "count" => fake()->numberBetween(10000, 11000)],
            ],
            [
                ["religion" => "roman catholic", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "aglipay", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "iglesia ni cristo", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "islam", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "others", "count" => fake()->numberBetween(10000, 11000)],
            ],
            [
                ["religion" => "roman catholic", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "aglipay", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "iglesia ni cristo", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "islam", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "others", "count" => fake()->numberBetween(10000, 11000)],
            ],
            [
                ["roman catholic", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "aglipay", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "iglesia ni cristo", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "islam", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "others", "count" => fake()->numberBetween(10000, 11000)],
            ],
            [
                ["roman catholic", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "aglipay", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "iglesia ni cristo", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "islam", "count" => fake()->numberBetween(10000, 11000)],
                ["religion" => "others", "count" => fake()->numberBetween(10000, 11000)],
            ],
        ];

        $barangays = [
            ["barangay" => "wawa", "male" => fake()->numberBetween(20000, 50000), "female" => fake()->numberBetween(20000, 50000), "household" => fake()->numberBetween(20000, 50000)],
            ["barangay" => "bagumbayan", "male" => fake()->numberBetween(20000, 50000), "female" => fake()->numberBetween(20000, 50000), "household" => fake()->numberBetween(20000, 50000)],
            ["barangay" => "halayhayin", "male" => fake()->numberBetween(20000, 50000), "female" => fake()->numberBetween(20000, 50000), "household" => fake()->numberBetween(20000, 50000)],
            ["barangay" => "hulo", "male" => fake()->numberBetween(20000, 50000), "female" => fake()->numberBetween(20000, 50000), "household" => fake()->numberBetween(20000, 50000)],
            ["barangay" => "imatong", "male" => fake()->numberBetween(20000, 50000), "female" => fake()->numberBetween(20000, 50000), "household" => fake()->numberBetween(20000, 50000)],
            ["barangay" => "malaya", "male" => fake()->numberBetween(20000, 50000), "female" => fake()->numberBetween(20000, 50000), "household" => fake()->numberBetween(20000, 50000)],
            ["barangay" => "niogan", "male" => fake()->numberBetween(20000, 50000), "female" => fake()->numberBetween(20000, 50000), "household" => fake()->numberBetween(20000, 50000)],
            ["barangay" => "quisao", "male" => fake()->numberBetween(20000, 50000), "female" => fake()->numberBetween(20000, 50000), "household" => fake()->numberBetween(20000, 50000)],
            ["barangay" => "takungan", "male" => fake()->numberBetween(20000, 50000), "female" => fake()->numberBetween(20000, 50000), "household" => fake()->numberBetween(20000, 50000)],
        ];

        return [
            "barangays" => json_encode($barangays),
            "census_year" => fake()->year(),
            "total_population" => fake()->numberBetween(200000, 500000),
            "religion" => json_encode($religions)
        ];
    }
}
