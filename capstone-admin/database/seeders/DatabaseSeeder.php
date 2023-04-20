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
        $service_process = [
            [
                "client_steps" => "Accomplish",
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
        ProgramsEvents::factory()->create([
            "title" => "Civil Registration Month",
            "authors" => "aldrin ternate",
            "description" => '
The Philippine Statistics Authority (PSA) spearheads the celebration of the Civil Registration Month. This annual celebration is relevant to the mandate of the PSA to enforce civil registration functions in the country and is conducted pursuant to Presidential Proclamation No. 682 signed on 28 January 1991 by former President Corazon C. Aquino, declaring February as the Civil Registration Month.
Its celebration aims to strengthen and intensify the commitment and advocacy of the PSA to deliver effective and efficient civil registration and vital statistics to the clients and stakeholders. This February 2023 marks the 33rd Civil Registration Month Celebration with the theme “”PSA @10” Providing Efficient and Effective Civil Registration and Vital Statistics through Digital Transformation”.
            ',
            "location" => "",
            "img_link" => "https://www.puratarlac.gov.ph/wp-content/uploads/330984255_1547715845712313_1719560758274453000_n.jpg",
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
        ProgramsEvents::factory()->create([
            "title" => "Family Week",
            "authors" => "aldrin ternate",
            "description" => trim('The celebration of National Family Week is pursuant to Presidential Proclamation No. 60 issued on September 28, 1992, which aims “to increase awareness on various family issues; enhance effectiveness of national and local efforts to carry out specific programs concerning families by generating new programs concerning families by generating new activities and strengthening existing ones; and promote collaboration among national and local non-governmental organizations in support of multi-sectoral activities.”'),
            "location" => "",
            "img_link" => "https://dilg.gov.ph/resizeimgfluid.php?path=events&pics=dilg_events_201599_a9bc7412b7.jpg&w=160",
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
        ProgramsEvents::factory()->create([
            "title" => "Fiesta in Pilila, Rizal",
            "authors" => "aldrin ternate",
            "description" => trim('
It is a 2nd class urban municipality in the province of Rizal, Philippines.  According to the latest census, it has a population of 58,525 inhabitants in 9,001 households.
Pililla is just few kilometers away from Tanay, Rizal. It is surrounded by farms, small mountains, planes and trees. Its nearby provinces are Laguna and Quezon. 
Pililla is a great place to experience the true culture of a province. It has preserved some religious and non-religious tradition such as the Santa Cruzan or Flores de Mayo, wherein beautiful men and women walk all over town on their gowns. Town Fiesta during the month of July is being visited by people from the city to experience great celebrations especially the amateur shows at night. Like other towns, Pililla holds basketball league competitions for youth during summer. Pililla is also a favorite destination of road cyclists because of its asphalted road specifically in Sitio Bugarin in Barangay Halayhayin. 
            '),
            "location" => "pililla, rizal",
            "img_link" => "https://scontent.fmnl4-4.fna.fbcdn.net/v/t1.6435-9/37954445_915526281972378_1758665335344463872_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=8bfeb9&_nc_ohc=sYhOpI5wwVwAX8tpFgY&_nc_ht=scontent.fmnl4-4.fna&oh=00_AfB-B_l3k0HnfU6-8O1EZpTn7Jhbm_JtChvZB9u0DzANGQ&oe=6465077B",
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

        # EXECUTIVES 
        Executives::factory()->create([
            "executive_name" => "Dan V. Masinsin",
            "position" => "mayor",
            "img_link" => "https://pilillarizal.gov.ph/wp-content/uploads/2022/12/hon-dan-v-masinsin_2.jpg",
            "start_term" => date_create("Jan 01, 2020"),
            "end_term" => date_create("Jan 01, 2026"),
        ]);
        Executives::factory()->create([
            "executive_name" => "Jaime C. Paz",
            "position" => "vice mayor",
            "img_link" => "https://scontent.fmnl4-4.fna.fbcdn.net/v/t39.30808-6/272993409_380198853774591_70468139508402916_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeE7WD6y4yGDGitKBmsv7POqlX4BJEVH1l6VfgEkRUfWXko67kZ7rT1XlM_yEXcKBsJLyrEG8rHc-Ku6-rkY_eoj&_nc_ohc=lRWPAZrrBN0AX--pE0q&_nc_zt=23&_nc_ht=scontent.fmnl4-4.fna&oh=00_AfAz4deZTasxmaTYYPOsqbxazXuteDHyW2qkmCxeQVwxkQ&oe=6441B8E9",
            "start_term" => date_create("Jan 01, 2020"),
            "end_term" => date_create("Jan 01, 2026"),
        ]);
        Executives::factory()->create([
            "executive_name" => "Hon. Dindo M. Abueg",
            "position" => "honorable",
            "img_link" => "https://pilillarizal.gov.ph/wp-content/uploads/2022/12/hon-dindo-m-abueg_1.jpg",
            "start_term" => date_create("Jan 01, 2020"),
            "end_term" => date_create("Jan 01, 2026"),
        ]);

        # HOTLINES
        Hotlines::factory()->create([
            "department" => "pililla MDRRMO",
            "smart" => "09169398558",
            "globe" => "",
            "landline" => "",
        ]);
        Hotlines::factory()->create([
            "department" => "pililla ambulannce",
            "smart" => "09153325455",
            "globe" => "",
            "landline" => "",
        ]);
        Hotlines::factory()->create([
            "department" => "pililla MHO",
            "smart" => "00175498147",
            "globe" => "",
            "landline" => "",
        ]);
        Hotlines::factory()->create([
            "department" => "pililla MSWD",
            "smart" => "09175498147",
            "globe" => "",
            "landline" => "",
        ]);
        Hotlines::factory()->create([
            "department" => "Bureau  of Fire Protection",
            "smart" => "09175222243",
            "globe" => "",
            "landline" => "",
        ]);
        # POPULATIONS
        Population::factory(1)->create();

        # JOB POSTINGS
        JobPosting::factory(10)->create();

        # TOURISM
        Tourism::factory()->create([
            "title" => "simbahan ng pililla",
            "authors" => "angelo ternate",
            "category" => "churches",
            "description" => trim('
### A humbe beginning
The parish church and town (pueblo) of Pililla was originally created as a visita or barrio of St. Jerome Parish in Morong and had jurisdiction over the following rancherias at the time of its creation: Monte Tan-ay (mountain), Tigbi (site), Quisao, Yacat (mountain), and Dolo (river) towards Jalajala. When the first missionaries arrived in Pililla in 1572, they named the place Pila, Morong, since, it was under the administration of Morong, a nearby town. In 1583, the town was separated and became independent from Morong and gained a new name, Pililla, which means “small Pila”, to distinguish it from Pila, Laguna.
It was not too long when the first church was erected by the first missionaries through the help of the townspeople using nipa and bamboo as building materials. But Pililla did not have a resident priest until 1590. It was a humble beginning, yet, filled with awe as the early people of Pililla showed their great desire to encounter God amidst their community. The first church was burned down after sometime. The second structure made of nipa and woods was again built but this, too, was burned down. In 1599, the Superior Gobierno issued the license allowing the construction of a stone church, which was done in the following years.  In 1606, Monte Tan-ay was separated from Pililla and became an independent town. In 1632, the church and the whole town of Pililla was burned, convincing the missionaries and townspeople to unite in rebuilding the town.
### The New Church
Finally, the missionaries through the leadership of Rev. Fr. Francisco de la Asuncion o Cañizares, O.F.M. decided to put up a stone church in 1670. The church was completed in 1673, and the parish was dedicated to St Mary Magdalene. Like most churches in Laguna, the wall of the church was made of adobe. The church was simple and severe in design. It was year 1676 when Jalajala was finally separated from Pililla and became an independent town. While in 1679, an unforgettable event happened when the Laguna de Bay (Laguna Lake) rose to such extraordinary height that the parish priest, Rev. Fr. Nicolas de Santiago, O.F.M. celebrated the mass in the choir loft and the people of Pililla attended mass riding in bancas inside the church. In 1848, Rev. Fr. Jose de Guadalajara, O.F.M. renovated all the altars and repaired the church and the adjacent convent. 
From 1851 to 1937 several priests were assigned as pastors of Pililla from the Franciscans and then from the Society of St. Columban (S.C.) or the Columbans. In 1938, Fr. Francis Vernon Douglas, S.C. was appointed pastor of Pililla. When Fr. Douglas arrived, he found out a half ruined church, a dilapidated presbytery and a mere handful practicing Catholics.  He also noticed that the people of Pililla were poor, their faith even more so. Fr. Douglas began working with the youth of Pililla organizing recreational activities and a social action committee. Before long, his labors began to bear fruits. The church was repaired, the presbytery made habitable and faith was gradually coming back to the people.
            '),
            "location" => "plaza",
            "img_link" => "https://pilillarizal.gov.ph/wp-content/uploads/2023/01/SMMP-colorized-7.jpg",
        ]);
        Tourism::factory()->create([
            "title" => "Pililla Lyger Opening",
            "authors" => "angelo ternate",
            "category" => "churches",
            "description" => trim('
## Our Animal Welfare Policy
Many tourism attractions around the world feature live animals in some way, whether in the wild or in captivity. At Tripadvisor, we believe every attraction has a responsibility to ensure that any animals in its care are treated humanely.
We know that most attraction operators act responsibly, and agree with the basic precept of treating animals humanely. But we also know that worldwide, the standards of care that animals receive can vary depending on local laws.
As an online platform used by millions, we recognize the role Tripadvisor can play in driving improvements in animal welfare standards across the tourism industry. As a result, we are proud to have introduced a set of industry-leading animal welfare guidelines that every bookable experience sold on our platform must comply with. 
            '),
            "location" => "Matagbak Rd, Pililla, Rizal",
            "img_link" => "https://pilillarizal.gov.ph/wp-content/uploads/2023/01/2CM08194-1024x576.jpg",
        ]);

        # FESTIVALS 
        Festival::factory()->create([
            'title' => "Fiesta ni Santo Niño",
            "authors" => "angelo ternate",
            "description" => trim('
It is a 2nd class urban municipality in the province of Rizal, Philippines.  According to the latest census, it has a population of 58,525 inhabitants in 9,001 households.
Pililla is just few kilometers away from Tanay, Rizal. It is surrounded by farms, small mountains, planes and trees. Its nearby provinces are Laguna and Quezon. 
Pililla is a great place to experience the true culture of a province. It has preserved some religious and non-religious tradition such as the Santa Cruzan or Flores de Mayo, wherein beautiful men and women walk all over town on their gowns. Town Fiesta during the month of July is being visited by people from the city to experience great celebrations especially the amateur shows at night. Like other towns, Pililla holds basketball league competitions for youth during summer. Pililla is also a favorite destination of road cyclists because of its asphalted road specifically in Sitio Bugarin in Barangay Halayhayin. 
            '),
            "img_link" => "https://www.rizalprovince.ph/tourism/rizal%20major%20tourist%20destination%20and%20festivals/baras/tromba%20festival/tromba%20(1).jpg"
        ]);

        # BUSINESSES
        Business::factory()->create([
            "title" => "robinsons pilila",
            "authors" => "aldrin ternate",
            "description" => trim("
Robinsons Malls is one of the largest shopping malls and retail operators in the Philippines. It was incorporated on September 9, 1997, by entrepreneur John Gokongwei Jr. to develop, conduct, operate and maintain the Robinsons commercial shopping centers and all related businesses, such as the lease of commercial spaces within the compound of shopping centers.[2][3]
Robinsons Malls has also its branches in China under the Robinsons Galleria name.
In March 2016, John Gokongwei, Jr's son, Lance Gokongwei took over the leadership of Robinsons Malls following his retirement.
            "),
            "category" => "store",
            "location" => "plaza",
            "img_link" => "https://images.jgsummit.com.ph/2022/12/15/5dc64980fcbcfb2170ebe2127fa572bf45bb753e.jpg",
        ]);
        Business::factory()->create([
            "title" => "7 eleven pililla",
            "authors" => "aldrin ternate",
            "description" => trim("
7-Eleven, Inc., stylized as 7-ELEVEn,[2][3] is a multinational chain of retail convenience stores, headquartered in Dallas, Texas. The chain was founded in 1927 as an ice house storefront in Dallas. It was named Tote'm Stores between 1928 and 1946. After 70% of the company was acquired by an affiliate Ito-Yokado in 1991, it was reorganized as a wholly owned subsidiary of Seven & I Holdings.[4][5]
7-Eleven operates, franchises, and licenses 78,029 stores in 19 countries and territories as of November 2021. While operating under its namesake brand globally, within the United States it operates as 7-Eleven nationally, as Speedway nationally but mostly in the Midwest & East Coast, and as Stripes Convenience Stores within the South Central United States; both Speedway and Stripes operate alongside 7-Eleven's namesake stores in several markets. 7-Eleven also operates A-Plus locations with the name licensed from owner and fellow Metroplex-based Energy Transfer Partners, though most of these stores have since been rebranded as standard 7-Eleven stores.
            "),
            "category" => "store",
            "location" => "plaza",
            "img_link" => "https://www.foodbusinessnews.net/ext/resources/2022/11/11/7ElevenStore_Lead.jpg?height=635&t=1668188154&width=1200",
        ]);

        # INVEST
        Invest::factory(5)->create();

        # PERMITS
        Permit::factory(5)->create();

        /* services */
        /* office of the mayor */
        Service::factory()->create([
            "service_department" => "office of the mayor",
            "intended_for" => json_encode(["students"]),
            "service_type" => "scholarship program",
            "service_requirements" => json_encode([
                "Proof of enrollment" => "School registrar",
                "Copy of Grade last semester" => "School registrar",
                "Photocopy of School ID" => "To be provided by student",
                "Letter of Request" => "Barangay",
                "Accomplished application form" => "Download the form online to be filled up by the student",
                "1 pc 2x2 photo" => "To be provided by studen"
            ]),
            "service_process" => json_encode([
                [
                    "client_steps" => "Accomplish the forms and submit the same along with other requirements.",
                    "agency_steps" => "check the completeness of submitted documents in accordance to the list of requirements (if completed proceed to the next step, if not inform the client about the lacking documents for submission)",
                    "fees" => "",
                    "process_time" => "5mins",
                    "person_responsible" => "MTO's staff"
                ],
                [
                    "client_steps" => "",
                    "agency_steps" => "interview the client for initial assessment",
                    "fees" => "",
                    "process_time" => "10mins",
                    "person_responsible" => "mary ann vidanes om staff"
                ],
                [
                    "client_steps" => "",
                    "agency_steps" => "advise the client to wait for the result of assesment",
                    "fees" => "",
                    "process_time" => "10mins",
                    "person_responsible" => "mary ann vidanes om staff"
                ],
                [
                    "client_steps" => "",
                    "agency_steps" => "evaluation and assessment - if the client is qualified - advise client for the announcement of schedule of distribution of the educational assistance",
                    "fees" => "",
                    "process_time" => "11mins",
                    "person_responsible" => "mary ann vidanes om staff"
                ],
                [
                    "client_steps" => "",
                    "agency_steps" => "if the client is qualified - advise client for the announcement of schedule of distribution of the educational assistance",
                    "fees" => "",
                    "process_time" => "11mins",
                    "person_responsible" => "mary ann vidanes om staff"
                ],
                [
                    "client_steps" => "",
                    "agency_steps" => "advise client for the announcement of schedule of distribution of the educational assistance",
                    "fees" => "",
                    "process_time" => " 11mins",
                    "person_responsible" => "mary ann vidanes om staff"
                ],
            ]),
        ]);
        Service::factory()->create([
            "service_department" => "office of the mayor",
            "intended_for" => json_encode(["general public"]),
            "service_type" => "civil wedding schedule",
            "service_requirements" => json_encode([
                "marriage license" => "municipal civil registry office",
                "certificate of no marriage (CENOMAR)" => "PSA",
                "cedula" => "barangay or municipal treasury office",
                "valid id" => "any government issued",
                "joint affidavit" => "notary public / office of the mayor",
            ]),
            "service_process" => json_encode([
                [
                    "client_steps" => "Ask assistance from the front desk",
                    "agency_steps" => "endorse to concerned staff",
                    "fees" => "",
                    "process_time" => "1min",
                    "person_responsible" => "desk officer OM"
                ],
                [
                    "client_steps" => "client to present the requirement and fill-up the form",
                    "agency_steps" => "assesment of documents. - informed the copule on the scheduled date. - prepare order of payment (solemnizing fee)",
                    "fees" => "",
                    "process_time" => "7mins",
                    "person_responsible" => "khrisitine atilon OM staff"
                ],
                [
                    "client_steps" => "payment of fees",
                    "agency_steps" => "accept payment and issue receipt",
                    "fees" => "",
                    "process_time" => "5mins",
                    "person_responsible" => "MTO's staff"
                ],
                [
                    "client_steps" => "confimation of wedding details",
                    "agency_steps" => "record and confirm their wedding details",
                    "fees" => "",
                    "process_time" => "3mins",
                    "person_responsible" => "khrisitine atilon OM staff"
                ],
            ]),
        ]);
        Service::factory()->create([
            "service_department" => "office of the mayor",
            "intended_for" => json_encode(["certificate of no pending case", "permit to carry firearms"]),
            "service_type" => "mayor clearance",
            "service_requirements" => json_encode([
                "filled-out reuqest form or request letter" => "office of the mayor",
                "certicate of no marriage (CENOMAR)" => "PSA",
                "cedula" => "barangay or municipal treasury office",
                "barangay clearance" => "barangay clearance barangay",
                "2 valid id" => "any government issued",
            ]),
            "service_process" => json_encode([
                [
                    "client_steps" => "submission of requirements",
                    "agency_steps" => "receive and assessment - advice the client to pay fee at treasury office",
                    "fees" => "",
                    "process_time" => "5mins",
                    "person_responsible" => "desk officer OM"
                ],
                [
                    "client_steps" => "payment of fees",
                    "agency_steps" => "prepare the clearance for signature of LCE",
                    "fees" => "",
                    "process_time" => "5mins",
                    "person_responsible" => "joy vidanes OM staff"
                ],
                [
                    "client_steps" => "claim the clearance",
                    "agency_steps" => "release the clearance to the client",
                    "fees" => "",
                    "process_time" => "3mins",
                    "person_responsible" => "joy vidanes OM staff"
                ],
            ]),
        ]);

        /* public employment office */
        Service::factory()->create([
            "service_department" => "public employment office",
            "intended_for" => json_encode(["general public"]),
            "service_type" => "application for special program for employment of students",
            "service_requirements" => json_encode([
                "barangay" => "",
            ]),
            "service_process" => json_encode([
                [
                    "client_steps" => "accomplish the forms and submit the same along with other requirements",
                    "agency_steps" => "chcek the completeness of submitted documents in accordance to the list of reuqirements",
                    "fees" => "",
                    "process_time" => "1min",
                    "person_responsible" => "desk officer OM"
                ],
            ]),
        ]);
        Service::factory()->create([
            "service_department" => "public employment office",
            "intended_for" => json_encode(["job seekers", "employer"]),
            "service_type" => "job fair",
            "service_requirements" => json_encode([
                "bio data or resume" => "",
                "company requirements (if available)" => "",
            ]),
            "service_process" => json_encode([
                [
                    "client_steps" => "search the jobs available and determine the company posted at official social media accoutn or wbesite of LGU",
                    "agency_steps" => "posting of job vacancy at official account or website",
                    "fees" => "",
                    "process_time" => "at least 1 week posting",
                    "person_responsible" => "PESO staff"
                ],
                [
                    "client_steps" => "submission of requirements and resume in position and the company applying for",
                    "agency_steps" => "receive the requirements and resume",
                    "fees" => "",
                    "process_time" => "2mins",
                    "person_responsible" => "PESO staff"
                ],
                [
                    "client_steps" => "wait for his/her number to be called",
                    "agency_steps" => "call the numbers who may enter inside the reqcruitment area",
                    "fees" => "",
                    "process_time" => "2mins",
                    "person_responsible" => "PESO staff"
                ],
            ]),
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
