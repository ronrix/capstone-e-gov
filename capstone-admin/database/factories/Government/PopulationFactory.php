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
            ["barangay" => "wawa", "male" => fake()->numberBetween(1000, 10000), "female" => fake()->numberBetween(1000, 10000), "household" => fake()->numberBetween(10, 500)],
            ["barangay" => "bagumbayan", "male" => fake()->numberBetween(1000, 10000), "female" => fake()->numberBetween(1000, 1000), "household" => fake()->numberBetween(10, 500)],
            ["barangay" => "halayhayin", "male" => fake()->numberBetween(1000, 10000), "female" => fake()->numberBetween(1000, 1000), "household" => fake()->numberBetween(100, 500)],
            ["barangay" => "hulo", "male" => fake()->numberBetween(20000, 10000), "female" => fake()->numberBetween(1000, 3000), "household" => fake()->numberBetween(100, 500)],
            ["barangay" => "imatong", "male" => fake()->numberBetween(1000, 10000), "female" => fake()->numberBetween(1000, 1300), "household" => fake()->numberBetween(200, 400)],
            ["barangay" => "malaya", "male" => fake()->numberBetween(1000, 10000), "female" => fake()->numberBetween(1000, 2000), "household" => fake()->numberBetween(20, 400)],
            ["barangay" => "niogan", "male" => fake()->numberBetween(1000, 10000), "female" => fake()->numberBetween(2000, 5000), "household" => fake()->numberBetween(20, 100)],
            ["barangay" => "quisao", "male" => fake()->numberBetween(1000, 10000), "female" => fake()->numberBetween(1000, 10000), "household" => fake()->numberBetween(100, 500)],
            ["barangay" => "takungan", "male" => fake()->numberBetween(1000, 10000), "female" => fake()->numberBetween(1000, 10000), "household" => fake()->numberBetween(190, 500)],
        ];

        return [
            "barangays" => json_encode($barangays),
            "census_year" => "2015",
            "total_population" => "64812",
            "religion" => json_encode($religions)
        ];
    }
}
