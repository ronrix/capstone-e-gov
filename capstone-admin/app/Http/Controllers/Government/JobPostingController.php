<?php

namespace App\Http\Controllers\Government;

use App\Models\Government\JobPosting;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

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
    public function create(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "job_title" => "required",
            "company_name" => "required",
            "author" => "required",
            "email" => "required|email",
            "job_location" => "required",
            "job_description" => "required",
            "job_salary" => "required",
            "job_schedule" => "required",
            "logo" => "image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000", # 2mb is the max 
        ]);

        /*
        * customizing the validation response
        */
        if ($validator->fails()) {
            # send the second error message if exists otherwise send the first one
            return response()->json([
                "res" => [
                    "msg" => $validator->messages()->all()[1] ?: $validator->messages()->all()[0],
                    "msg_1" => $validator->messages()->all()[0] ?: $validator->messages()->all()[0],
                    "status" => 400,
                ]
            ], 400);
        }

        try {
            //code...
            $jobs = new JobPosting;
            if ($request->file("logo")) {
                $file = $request->file("logo");
                $filename = uniqid() . "." . $file->getClientOriginalExtension();
                $path = "uploads/job-posting/" . $filename;

                # create a folder if not exists before saving the image
                $folder = "uploads/job-posting/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }

                Image::make($file)->save(public_path($path)); // save the file image
                $jobs->logo = $path;
            }

            $jobs->job_title = strtolower($request->input("job_title"));
            $jobs->job_location = strtolower($request->input("job_location"));
            $jobs->company_name = strtolower($request->input("company_name"));
            $jobs->author = strtolower($request->input("author"));
            $jobs->email = strtolower($request->input("email"));
            $jobs->job_description = strtolower($request->input("job_description"));
            $jobs->job_salary = $request->input("job_salary");
            $jobs->job_schedule = $request->input("job_schedule");
            $jobs->save();

            return response()->json([
                "jobs" => JobPosting::all(),
                "res" => [
                    "msg" => "Successfully create new job",
                    "status" => 200
                ]
            ], 200);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json([
                "res" => [
                    "msg" => $err->getMessage(),
                    "status" => 400
                ]
            ], 400);
        }
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
            "job_title" => "required",
            "company_name" => "required",
            "author" => "required",
            "email" => "required|email",
            "job_location" => "required",
            "job_description" => "required",
            "job_salary" => "required",
            "job_schedule" => "required",
            "logo" => "nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000", # 2mb is the max 
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

            // update the logo if exists
            if ($request->file("logo")) {
                // delete the current img before updating it
                $old_logo = $jobs->logo;
                if (file_exists($old_logo)) {
                    unlink($old_logo);
                }

                $file = $request->file("logo");
                $filename = uniqid() . "." . $file->getClientOriginalExtension();
                $path = "uploads/job-posting/" . $filename;

                # create a folder if not exists before saving the image
                $folder = "uploads/job-posting/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }

                Image::make($file)->save(public_path($path)); // save the file image
                $jobs->logo = $path;
            }


            $jobs->job_title = strtolower($request->input("job_title"));
            $jobs->job_location = strtolower($request->input("job_location"));
            $jobs->company_name = strtolower($request->input("company_name"));
            $jobs->author = strtolower($request->input("author"));
            $jobs->email = strtolower($request->input("email"));
            $jobs->job_description = strtolower($request->input("job_description"));
            $jobs->job_salary = $request->input("job_salary");
            $jobs->job_schedule = $request->input("job_schedule");
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

    public function deleteOne(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), ["id" => "required"]);

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
            return response()->json(["jobs" => JobPosting::all(), "res" => ["msg" => "Successfully deleted a job post", "status" => 200]]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]]);
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
