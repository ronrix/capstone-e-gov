<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\About\Contact;
use App\Models\About\OfficialSeal;
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
        Permit::factory(10)->create();

        /* services */
        Service::factory()->create([
            "service_department" => "office of the mayor",
            "service_type" => "scholarship program",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        Service::factory()->create([
            "service_department" => "office of the mayor",
            "service_type" => "mayor clearance",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        Service::factory()->create([
            "service_department" => "office of the mayor",
            "service_type" => "civil wedding",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        Service::factory()->create([
            "service_department" => "MSWD",
            "service_type" => "government id",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        Service::factory()->create([
            "service_department" => "MSWD",
            "service_type" => "replacement of senior citizen",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        Service::factory()->create([
            "service_department" => "public employment service office",
            "service_type" => "special program employment for students",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        Service::factory()->create([
            "service_department" => "public employment service office",
            "service_type" => "job fair",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        /* agriculture */
        Service::factory()->create([
            "service_department" => "agriculture department",
            "service_type" => "technical assistance for farmers",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        Service::factory()->create([
            "service_department" => "agriculture department",
            "service_type" => "treatment and vaccination of animals",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        Service::factory()->create([
            "service_department" => "agriculture department",
            "service_type" => "distributions of assorted seeds",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        Service::factory()->create([
            "service_department" => "agriculture department",
            "service_type" => "delivery of farm and fishery inputs",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        Service::factory()->create([
            "service_department" => "agriculture department",
            "service_type" => "issuance of moa certification",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);
        Service::factory()->create([
            "service_department" => "agriculture department",
            "service_type" => "capacity building enhancement training",
            "service_requirements" => implode(",", $service_requirements),
            "service_process" => json_encode($service_process),
        ]);

        OfficialSeal::factory(1)->create();
        Contact::factory()->create([
            "contact_type" => "HR department",
            "contact_details" => json_encode([
                "mobile number" => ["+639-234-554-678"],
                "telephone number" => ["(555) 555-1234"],
            ])
        ]);
        Contact::factory()->create([
            "contact_type" => "social media links",
            "contact_details" => json_encode([
                "facebook" => ["https://www.facebook.com/BetterPililla"],
                "twitter" => ["https://twitter.com"],
                "gmail" => ["betterpillla@gmail.com"],
            ])
        ]);
    }
}
