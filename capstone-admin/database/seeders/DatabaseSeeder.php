<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Business\Business;
use App\Models\Business\Invest;
use App\Models\Business\Permit;
use App\Models\Government\Executives;
use App\Models\Government\Hotlines;
use App\Models\Government\News;
use App\Models\Government\Population;
use App\Models\Government\JobPosting;
use App\Models\Government\ProgramsEvents;
use App\Models\Services\Service;
use App\Models\Tourism\Festival;
use App\Models\Tourism\Tourism;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $service_requirements = ["Proof of Enrollment", "Photocopy of School ID", "Letter of Request"];
        $service_process = [
            [
                "client_steps" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled",
                "agency_steps" => "office of the mayor",
                "fees" => "1000",
                "process_time" => "1min"
            ],
            [
                "client_steps" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled",
                "agency_steps" => "office of the mayor",
                "fees" => "1000",
                "process_time" => "1min"
            ],
        ];

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        News::factory(10)->create();
        ProgramsEvents::factory(10)->create();
        Executives::factory(10)->create();
        Hotlines::factory(10)->create();
        Population::factory(10)->create();
        JobPosting::factory(10)->create();
        Tourism::factory(10)->create();
        Festival::factory(10)->create();
        Business::factory(10)->create();
        Invest::factory(10)->create();
        Service::factory()->create([
            "service_department" => "office of the mayor",
            "service_type" => "scholarship program",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        Permit::factory(10)->create();
    }
}
