<?php

namespace App\Http\Controllers\Government;

use App\Models\Government\Population;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PopulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(["populations" => Population::orderBy("census_year", "desc")->get()]);
    }

    public function deleteOne(Request $request) {
         // validate
        $validator = Validator::make($request->all(), [
            "id" => "required", 
        ]); 

        /*
        * customizing the validation response
        */
        if ($validator->fails()) {
            # send the second error message if exists otherwise send the first one
            return response()->json([
                "res" => [
                    "msg" => $validator->messages(),
                    "status" => 400,
                ]
            ]);
        }

        $id = $request->input("id");
        try {
            Population::findOrFail($id)->delete();
            return response()->json([ "populations" => Population::orderBy("census_year", "desc")->get(), "res" => [ "msg" => "Successfully deleted a news", "status" => 200 ]]);
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
    public function create(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "census_year" => "required", 
            "total_population" => "required", 
            "barangays" => "required", 
            "religions" => "required", 
        ]); 

        /*
        * customizing the validation response
        */
        if ($validator->fails()) {
            # send the second error message if exists otherwise send the first one
            return response()->json([
                "res" => [
                    "msg" => $validator->messages(),
                    "status" => 400,
                ]
            ]);
        }

        try {
            //code...
            $hotline = new Population;
            $hotline->census_year = $request->input("census_year"); # barangays associative array
            $hotline->barangays = json_encode($request->input("barangays")); # barangays associative array
            $hotline->total_population = json_encode($request->input("total_population")); # barangays associative array
            $hotline->religion = json_encode($request->input("religions")); # religion associative array
            $hotline->save();

            return response()->json([
                "populations" => Population::orderBy("census_year", "desc")->get(),
                "res" => [
                    "msg" => "Successfully created new census",
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
     * @param  \App\Models\Population  $population
     * @return \Illuminate\Http\Response
     */
    public function show(Population $population)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Population  $population
     * @return \Illuminate\Http\Response
     */
    public function edit(Population $population)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Population  $population
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required", 
            "type" => "required", 
            "idx" => "required", 
            "value" => "required", 
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

        $id = $request->input("id"); # id of the table row
        $type = $request->input("type"); # property name
        $value = $request->input("value"); # the new value
        $idx = $request->input("idx"); # id of the selected array value. where to update

        try {
            //code...
            $hotline = Population::findOrFail($id);
            $barangays = json_decode($hotline->barangays, true); # barangays associative array
            $religions = json_decode($hotline->religion, true); # religion associative array

            $toUpdate = explode("|", $type)[1]; # specific key to update

            # check if religion is equal to the request religion and update the value
            if(str_contains($type, "religion")) {
                $religions[$idx]["count"] = $value; # update the value of specific barangay
                $hotline->religion = json_encode($religions); # save the updated value 
            }
            # else: update the baragany name, male, female, and household value property
            else {
                $barangays[$idx][$toUpdate] = $value; # update the value of specific barangay
                $hotline->barangays = json_encode($barangays); # save the updated value 
            }

            # save the updated value
            $hotline->save();

            return response()->json([
                "populations" => Population::orderBy("census_year", "desc")->get(),
                "res" => [
                    "msg" => "Successfully updated",
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Population  $population
     * @return \Illuminate\Http\Response
     */
    public function destroy(Population $population)
    {
        //
    }
}
