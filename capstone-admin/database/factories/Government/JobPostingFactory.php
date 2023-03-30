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
        $job_types = [
            "developer",
            "designer",
            "accounting",
            "helper",
            "welder",
        ];
        $job_schedules = [ "remote", "temporary", "contractual", "fixed term", "full time", "part time", "internship" ];

        return [
            "job_title" => fake()->jobTitle(),
            "job_location" => fake()->streetAddress(),
            "job_description" => fake()->paragraph(5),
            "job_type" => fake()->randomElement($job_types),
            "job_schedule" => implode(", ", [fake()->randomElement($job_schedules), fake()->randomElement($job_schedules), fake()->randomElement($job_schedules)]),
            "job_salary" => fake()->numberBetween(20000, 50000),
        ];
    }
}
