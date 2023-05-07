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
        $job_schedules = ["remote", "temporary", "contractual", "fixed term", "full time", "part time", "internship"];

        return [
            "logo" => "https://s3.amazonaws.com/cdn.designcrowd.com/blog/100-Famous-Brand%20Logos-From-The-Most-Valuable-Companies-of-2020/apple-logo.png",
            "email" => "company@company.com",
            "author" => "Ronrix Lante",
            "company_name" => "Apple Inc.",
            "job_title" => fake()->jobTitle(),
            "job_location" => fake()->streetAddress(),
            "job_description" => fake()->paragraph(5),
            "job_schedule" => implode(", ", [fake()->randomElement($job_schedules), fake()->randomElement($job_schedules), fake()->randomElement($job_schedules)]),
            "job_salary" => fake()->numberBetween(20000, 50000),
        ];
    }
}
