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

        # NEWS REAL DATA
        News::factory()->create([
            "title" => 'Philippines Moves to Shut ABS-CBN, Its Leading Broadcast Network',
            "description" => trim('
                It’s the latest push by the administration of President Rodrigo Duterte against media outlets he views as critical of his government.
                MANILA — The Philippine government moved Monday to end the franchise of the country’s leading broadcast network, the latest push by the administration of President Rodrigo Duterte against media outlets that have been critical of his leadership.
                The Philippine solicitor general, Jose Calida, lodged a complaint with the country’s highest court, accusing ABS-CBN Corp. and its subsidiary, ABS-CBN Convergence, of violating the operating franchise it was granted by Congress, which is set to expire in March.
                The move comes despite the fact that the House of Representatives has yet to start deliberating several bills supporting the renewal of the franchise. It was not clear how Mr. Calida’s petition would affect that legislation.
                "We want to put an end to what we discovered to be highly abusive practice of ABS-CBN benefiting a greedy few at the expense of millions of its loyal subscribers," Mr. Calida said in a statement announcing the move. "These practices have gone unnoticed or were disregarded for years."
                ### Inside the Media Industry
                - NPR: The broadcaster said it would suspend all Twitter use after the social network designated it "U.S. state-affiliated media."
                - Vox Media: The company said it was spinning off NowThis, a news site whose videos regularly go viral on Instagram and TikTok, ahead of the 2024 presidential election.
                - Farewell, HBO: Executives at Warner Bros. Discovery announced that the new streaming service expected to replace HBO Max, uniting HBO titles and Discovery reality series, would be named Max.  
                - The Guardian: Dana Canedy, the first Black woman to serve as the publisher of Simon & Schuster, was named managing editor of Guardian U.S.
                But critics of Mr. Duterte say he is on the warpatho against media entities that have questioned his drug war, which has drawn international condemnation. ABS-CBN, along with the Filipino online news site Rappler, have been at the forefront of critical reporting about the antidrug campaign, which has left nearly 6,000 people dead since Mr. Duterte took office in 2016.
                Mr. Calida said the government will prove that ABS-CBN has been broadcasting for a fee, “which is beyond the scope of its legislative franchise.” He also accused the company of hiding behind what he said was an “elaborately crafted corporate veil” by allowing foreign investors to take part in its ownership.
                He stressed that ABS-CBN “abused the privilege granted by the state” when it introduced a pay-per-view channel without approval by the government’s telecommunications commission.
                As he has with ABS-CBN, Mr. Duterte has personally gone after Rappler, arguing that it was partly owned by foreign investors. 
            '),
            "authors" => "Jason Gutierrez",
            "img_link" => "https://static01.nyt.com/images/2020/02/10/world/10philippines-1/merlin_168703272_ffcf8085-c80e-4d07-a50f-b8b2eff58506-superJumbo.jpg?quality=75&auto=webp",
            "comments" => json_encode([
                [
                    "author" => fake()->name(),
                    "avatar" => fake()->image(),
                    "comment" => fake()->sentence(),
                    "created_at" => fake()->dateTime(),
                ],
                [
                    "author" => fake()->name(),
                    "avatar" => fake()->image(),
                    "comment" => fake()->sentence(),
                    "created_at" => fake()->dateTime(),
                ],
            ]),
        ]);
        News::factory()->create([
            "title" => "Justice chief mulls tagging Teves a 'terrorist'",
            "description" => trim('
                JUSTICE Secretary Cesar Crispin Remulla on Monday said the department is studying the possibility of tagging Negros Oriental Rep. Arnolfo Teves Jr. as "terrorist" to force him to surrender.
                Teves, who is in hiding abroad, was implicated in the killing of Negros Oriental governor Roel Degamo.
                Remulla, during the Senate Committee on Public Order hearing on political killings, said that the circumstances surrounding the killing of Degamo fell under the Anti-Terrorism Law.
                "In this case, the activities that led to the killing [of governor Degamo] on March 4 are all covered under the Anti-Terror Law, [such as] the recruitment [of assassins], the financing, the purchase of firearms, [and] the distribution of firearms," Remulla said.
                He added that as a solution to the "impasse" on the surrender of Teves, "we are looking at designating him or proscribing him as a terrorist, to have him proscribed by the CA (Court of Appeals) and designated by the Anti-Terrorism Council because of the acts that happened."
                "That is really the intent — the proscription and the designation to be our goal further down the road because if the person will not surrender, then we will have to make
                the world smaller for him and that is the purpose of the Anti-Terrorism Law is that the whole," Remulla said.
                "Everything that transpired [in the Degamo killing] has terrorism in it. However, when cases were filed individually, we could not file an anti-terror case immediately because it takes a lot of legal theory and a lot of research to prove a terrorism case," he said.
            '),
            "authors" => "Bernadette E. Tamayo",
            "img_link" => "https://cdn4.premiumread.com/?url=https://www.manilatimes.net/manilatimes/uploads/images/2023/04/17/180802.jpg&w=700&q=100&f=webp",
            "comments" => json_encode([
                [
                    "author" => fake()->name(),
                    "avatar" => fake()->image(),
                    "comment" => fake()->sentence(),
                    "created_at" => fake()->dateTime(),
                ],
                [
                    "author" => fake()->name(),
                    "avatar" => fake()->image(),
                    "comment" => fake()->sentence(),
                    "created_at" => fake()->dateTime(),
                ],
            ]),
        ]);

        # PROGRAMS AND EVENTS 
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
