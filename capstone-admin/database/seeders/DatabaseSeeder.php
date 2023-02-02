<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\About\About;
use App\Models\Business\Business;
use App\Models\Business\Invest;
use App\Models\Government\Advisory;
use App\Models\Government\Executives;
use App\Models\Government\Hotlines;
use App\Models\Government\News;
use App\Models\Government\Population;
use App\Models\Government\JobPosting;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        News::factory(10)->create();
        Advisory::factory(10)->create();
        Executives::factory(10)->create();
        Hotlines::factory(10)->create();
        Population::factory(10)->create();
        JobPosting::factory(10)->create();
        Tourism::factory(10)->create();
        Festival::factory(10)->create();
        Business::factory(10)->create();
        Invest::factory(10)->create();
        About::factory(10)->create();
        Service::factory(10)->create();
    }
}
