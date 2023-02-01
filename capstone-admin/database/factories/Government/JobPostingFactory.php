<?php

namespace Database\Factories\Government;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Government\JobPosting>
 */
class JobPostingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "job_title" => fake()->jobTitle(),
            "job_place" => fake()->streetAddress(),
            "job_description" => fake()->paragraph(5),
            "job_type" => "remote, temporary, contractual, fixed term, full time",
            "job_qualifications" => fake()->paragraph(5),
            "job_salary" => fake()->randomDigit(),
        ];
    }
}
