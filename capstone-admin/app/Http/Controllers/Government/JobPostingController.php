<?php

namespace App\Http\Controllers\Government;

use App\Models\Government\JobPosting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobPostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return response()->json(JobPosting::all());
        return response()->json(["jobs" => JobPosting::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Government\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function show(JobPosting $jobPosting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Government\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function edit(JobPosting $jobPosting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Government\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required", 
            "job_title" => "required", 
            "job_type" => "required", 
            "job_description" => "required", 
            "job_salary" => "required", 
            "job_schedule" => "required", 
        ]); 

        /*
        * customizing the validation response
        */
        if ($validator->fails()) {
            # send the second error message if exists otherwise send the first one
            return response()->json([
                "res" => [
                    "msg" => $validator->messages()->all()[1] ?: $validator->messages()->all()[0],
                    "status" => 400,
                ]
            ]);
        }

        $id = $request->input("id");

        try {
            //code...
            $jobs = JobPosting::findOrFail($id);
            $jobs->job_title = $request->input("job_title");
            $jobs->job_type = $request->input("job_type");
            $jobs->job_description = $request->input("job_description");
            $jobs->job_salary = $request->input("job_salary");
            $jobs->job_schedule = implode(",", $request->input("job_schedule"));
            $jobs->save();

            return response()->json([
                "jobs" => JobPosting::all(),
                "res" => [
                    "msg" => "Successfully updated job postings",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json([
                "res" => [
                    "msg" => $err->getMessage(),
                    "status" => 400
                ]
            ]);
        }
    }

    public function deleteOne(Request $request) {
         // validate
        $validator = Validator::make($request->all(), [ "id" => "required" ]); 

        /*
        * customizing the validation response
        */
        if ($validator->fails()) {
            # send the second error message if exists otherwise send the first one
            return response()->json([
                "res" => [
                    "msg" => $validator->messages()->all()[1] ?: $validator->messages()->all()[0],
                    "status" => 400,
                ]
            ]);
        }

        $id = $request->input("id");

        try {
            //code...
            JobPosting::findOrFail($id)->delete();
            return response()->json([ "jobs" => JobPosting::all(), "res" => [ "msg" => "Successfully deleted a job post", "status" => 200 ]]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json([ "res" => ["msg" => $err->getMessage(), "status" => 400 ]]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Government\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobPosting $jobPosting)
    {
        //
    }
}
