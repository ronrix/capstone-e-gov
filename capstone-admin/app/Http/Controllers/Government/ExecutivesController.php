<?php

namespace App\Http\Controllers\Government;

use App\Models\Government\Executives;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image, File;

class ExecutivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $date_now;

    public function __construct()
    {
        $this->date_now = Carbon::now();
    }

    public function index()
    {
        //
        $officials = Executives::whereDate('start_term', '<=', $this->date_now)
            ->whereDate('end_term', '>=', $this->date_now)
            ->orderBy("end_term", "desc")
            ->get();
        
        return response()->json(['currentOfficials' => $officials]);
    }

    public function getFormerOfficials()
    {
        //
        $officials = Executives::whereDate('end_term', '<=', $this->date_now)->orderBy("end_term", "desc")->get();
        
        return response()->json(['formerOfficials' => $officials]);
    }

    public function getBarangayOfficials()
    {
        //
        $officials = Executives::where('position', 'LIKE', "%barangay official%")->orderBy("end_term", "desc")->get();
        return response()->json(['barangayOfficials' => $officials]);
    }

    public function getDepartmentHeads()
    {
        # get the new data
        $officials = Executives::where('position', "LIKE", '%agriculture%')
            ->orWhere("position", "LIKE",'%department%')
            ->orWhere("position", "LIKE",'%treasurer%')
            ->orWhere("position", "LIKE",'%hr%')
            ->orderBy("end_term", "desc")
            ->get();
        return response()->json(['departmentHeads' => $officials]);
    }

    /*
    * Delete executive data by id
    */ 
    public function deleteOneFromCurrent(Request $request)
    {
        // get the passed parameter id
        $request->validate(["id" => ["required"]]);
        $id = $request->input("id");

        try {
            Executives::where('id', $id)->delete();

            # get the new data
            $officials = Executives::whereDate('start_term', '<=', $this->date_now)
                ->whereDate('end_term', '>=', $this->date_now)
                ->orderBy("end_term", "desc")
                ->get();

            return response()->json([ "officialData" => $officials, "res" => [ "msg" => "Successfully deleted a official", "status" => 200 ]]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([ "res" => ["msg" => $th, "status" => 400 ]]);
        }
    }

    public function deleteOneFromFormer(Request $request)
    {
        // get the passed parameter id
        $request->validate(["id" => ["required"]]);
        $id = $request->input("id");


        try {
            Executives::where('id', $id)->delete();

            # get new data
            $officials = Executives::whereDate('end_term', '<=', $this->date_now)
                ->orderBy("end_term", "desc")
                ->get();

            return response()->json([ "officialData" => $officials, "res" => [ "msg" => "Successfully deleted a official", "status" => 200 ]]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([ "res" => ["msg" => $th, "status" => 400 ]]);
        }
    }

    public function deleteOneBarangay(Request $request)
    {
        // get the passed parameter id
        $request->validate(["id" => ["required"]]);
        $id = $request->input("id");


        try {
            Executives::where('id', $id)->delete();

            # get new data
            $officials = Executives::where('position', "LIKE", "%barangay official%")
                ->orderBy("end_term", "desc")
                ->get();
            return response()->json([ "officialData" => $officials, "res" => [ "msg" => "Successfully deleted a official", "status" => 200 ]]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([ "res" => ["msg" => $th, "status" => 400 ]]);
        }
    }

    public function deleteOneDepHead(Request $request)
    {
        // get the passed parameter id
        $request->validate(["id" => ["required"]]);
        $id = $request->input("id");


        try {
            Executives::where('id', $id)->delete();

            # get new data
            $officials = Executives::whereIn('position', ['agriculture', 'treasurer', 'hr'])
                ->orderBy("end_term", "desc")
                ->get();
            return response()->json([ "officialData" => $officials, "res" => [ "msg" => "Successfully deleted a official", "status" => 200 ]]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([ "res" => ["msg" => $th, "status" => 400 ]]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCurrentOfficial(Request $request)
    {
         // validate
        $validator = Validator::make($request->all(), [
            "fullName" => "required", 
            "position" => "required", 
            "startTerm" => "required|date", 
            "endTerm" => "required|date", 
            "imgFile" => "image|mimes:jpeg,png,jpg,gif,svg", # 2mb is the max 
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

        try {
            if($request->file("imgFile")) {
                $file = $request->file("imgFile");
                // save all the images
                $filename = uniqid() . "." . $file->getClientOriginalExtension();
                $path = "uploads/" .$filename;
                Image::make($file)->save(public_path($path)); // save the file image
                
                $exec = new Executives;
                $exec->executive_name = strtolower($request->input("fullName"));
                $exec->position = strtolower($request->input("position"));
                $exec->start_term = Carbon::parse($request->input("startTerm"))->format("Y-m-d H:i:s");
                $exec->end_term = Carbon::parse($request->input("endTerm"))->format("Y-m-d H:i:s");
                $exec->img_link = $path;
                $exec->save();
            }     

            # get the new data
            $officials = Executives::whereDate('start_term', '<=', $this->date_now)
                ->whereDate('end_term', '>=', $this->date_now)
                ->orderBy("end_term", "desc")
                ->get();
            return response()->json([
                "officialData" => $officials,
                "res" => [
                    "msg" => "Successfully created official",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json([ "res" => ["msg" => $err->getMessage(), "status" => 400 ]]);
        }
    }

    public function createFormerOfficial(Request $request)
    {
         // validate
        $validator = Validator::make($request->all(), [
            "fullName" => "required", 
            "position" => "required", 
            "startTerm" => "required|date", 
            "endTerm" => "required|date", 
            "imgFile" => "image|mimes:jpeg,png,jpg,gif,svg", # 2mb is the max 
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

        try {
            if($request->file("imgFile")) {
                $file = $request->file("imgFile");
                // save all the images
                $filename = uniqid() . "." . $file->getClientOriginalExtension();
                $path = "uploads/" .$filename;
                Image::make($file)->save(public_path($path)); // save the file image
                
                $exec = new Executives;
                $exec->executive_name = strtolower($request->input("fullName"));
                $exec->position = strtolower($request->input("position"));
                $exec->start_term = Carbon::parse($request->input("startTerm"))->format("Y-m-d H:i:s");
                $exec->end_term = Carbon::parse($request->input("endTerm"))->format("Y-m-d H:i:s");
                $exec->img_link = $path;
                $exec->save();
            }     

            # get the new data
            $officials = Executives::whereDate('end_term', '<=', $this->date_now)
                ->orderBy("end_term", "desc")
                ->get();
            return response()->json([
                "officialData" => $officials,
                "res" => [
                    "msg" => "Successfully created official",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json([ "res" => ["msg" => $err->getMessage(), "status" => 400 ]]);
        }
    }

    public function createBarangayOfficial(Request $request)
    {
         // validate
        $validator = Validator::make($request->all(), [
            "fullName" => "required", 
            "position" => "required", 
            "startTerm" => "required|date", 
            "endTerm" => "required|date", 
            "imgFile" => "image|mimes:jpeg,png,jpg,gif,svg", # 2mb is the max 
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

        try {
            if($request->file("imgFile")) {
                $file = $request->file("imgFile");
                // save all the images
                $filename = uniqid() . "." . $file->getClientOriginalExtension();
                $path = "uploads/" .$filename;
                Image::make($file)->save(public_path($path)); // save the file image
                
                $exec = new Executives;
                $exec->executive_name = strtolower($request->input("fullName"));
                $exec->position = strtolower($request->input("position"));
                $exec->start_term = Carbon::parse($request->input("startTerm"))->format("Y-m-d H:i:s");
                $exec->end_term = Carbon::parse($request->input("endTerm"))->format("Y-m-d H:i:s");
                $exec->img_link = $path;
                $exec->save();
            }     

            # get the new data
            $officials = Executives::where('position', "LIKE", "%barangay official%")
                ->orderBy("end_term", "desc")
                ->get();
            return response()->json([
                "officialData" => $officials,
                "res" => [
                    "msg" => "Successfully created official",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json([ "res" => ["msg" => $err->getMessage(), "status" => 400 ]]);
        }
    }

    public function createDepHead(Request $request)
    {
         // validate
        $validator = Validator::make($request->all(), [
            "fullName" => "required", 
            "position" => "required", 
            "startTerm" => "required|date", 
            "endTerm" => "required|date", 
            "imgFile" => "image|mimes:jpeg,png,jpg,gif,svg", # 2mb is the max 
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

        try {
            if($request->file("imgFile")) {
                $file = $request->file("imgFile");
                // save all the images
                $filename = uniqid() . "." . $file->getClientOriginalExtension();
                $path = "uploads/" .$filename;
                Image::make($file)->save(public_path($path)); // save the file image
                
                $exec = new Executives;
                $exec->executive_name = strtolower($request->input("fullName"));
                $exec->position = strtolower($request->input("position"));
                $exec->start_term = Carbon::parse($request->input("startTerm"))->format("Y-m-d H:i:s");
                $exec->end_term = Carbon::parse($request->input("endTerm"))->format("Y-m-d H:i:s");
                $exec->img_link = $path;
                $exec->save();
            }     

            # get the new data
            $officials = Executives::where('position', "LIKE", '%agriculture%')
                ->orWhere("position", "LIKE",'%department%')
                ->orWhere("position", "LIKE",'%treasurer%')
                ->orWhere("position", "LIKE",'%hr%')
                ->orderBy("end_term", "desc")
                ->get();
            return response()->json([
                "officialData" => $officials,
                "res" => [
                    "msg" => "Successfully created official",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json([ "res" => ["msg" => $err->getMessage(), "status" => 400 ]]);
        }
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
     * @param  \App\Models\Executives  $executives
     * @return \Illuminate\Http\Response
     */
    public function show(Executives $executives)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Executives  $executives
     * @return \Illuminate\Http\Response
     */
    public function edit(Executives $executives)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Executives  $executives
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Executives $executives)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Executives  $executives
     * @return \Illuminate\Http\Response
     */
    public function destroy(Executives $executives)
    {
        //
    }
}
