<?php

namespace App\Http\Controllers;

use App\Models\Business\Business;
use App\Models\Government\JobPosting;
use App\Models\Government\News;
use App\Models\Government\ProgramsEvents;
use App\Models\Services\Service;
use App\Models\Tourism\Festival;
use App\Models\Tourism\Tourism;
use Illuminate\Http\Request;

class SearchQueryController extends Controller
{
    public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        // perform search logic using $query here
        try {
            $tourism = Tourism::select('id', 'title', 'description')
                ->whereRaw("MATCH (title, description) AGAINST (? IN BOOLEAN MODE)", [$searchQuery])
                ->get()->toArray();
            $festivals = Festival::select('id', 'title', 'description')
                ->whereRaw("MATCH (title, description) AGAINST (? IN BOOLEAN MODE)", [$searchQuery])
                ->get()->toArray();
            $business = Business::select('id', 'title', 'description')
                ->whereRaw("MATCH (title, description) AGAINST (? IN BOOLEAN MODE)", [$searchQuery])
                ->get()->toArray();
            $news = News::select('id', 'title', 'description')
                ->whereRaw("MATCH (title, description) AGAINST (? IN BOOLEAN MODE)", [$searchQuery])
                ->get()->toArray();
            $job = JobPosting::select('id', 'job_title AS title', 'job_description AS description')
                ->whereRaw("MATCH (job_title, job_description) AGAINST (? IN BOOLEAN MODE)", [$searchQuery])
                ->get()->toArray();
            $services = Service::select('id', 'title', 'description')
                ->whereRaw("MATCH (title, description) AGAINST (? IN BOOLEAN MODE)", [$searchQuery])
                ->get()->toArray();
            $events = ProgramsEvents::select('id', 'title', 'description')
                ->whereRaw("MATCH (title, description) AGAINST (? IN BOOLEAN MODE)", [$searchQuery])
                ->get()->toArray();

            // Combine the results from the users and products tables
            $results = array_merge(["tourist-attractions" => $tourism], ["festivals" => $festivals], ["business" => $business], ["news" => $news], ["job" => $job], ["services" => $services], ["programs-events" => $events]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }

        return response()->json(["results" => $results]);
    }
}
