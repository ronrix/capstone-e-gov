<?php

namespace App\Http\Controllers\Government;

use App\Models\Government\Hotlines;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotlinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(["hotlines" => Hotlines::orderBy("id", "desc")->get()]);
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
            "department" => "required",
            "smart" => "required",
            "globe" => "required",
            "landline" => "required",
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
            //code...
            $hotline = new Hotlines;
            $hotline->department = strtolower($request->input("department"));
            $hotline->smart = $request->input("smart");
            $hotline->globe = $request->input("globe");
            $hotline->landline = $request->input("landline");
            $hotline->save();

            return response()->json([
                "hotlines" => Hotlines::orderBy("id", "desc")->get(),
                "res" => [
                    "msg" => "Successfully added new hotline",
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotlines  $hotlines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "number" => "required",
            "provider" => "required",
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
            $hotline = Hotlines::findOrFail($id);

            // check what provider to update
            if ($request->input("provider") === "smart") {
                $hotline->smart = $request->input("number");
            } else if ($request->input("provider") === "globe") {
                $hotline->globe = $request->input("number");
            } else if ($request->input("provider") === "landline") {
                $hotline->landline = $request->input("number");
            } else if ($request->input("provider") === "department") { # will update the title instead
                $hotline->department = $request->input("number");
            }

            $hotline->save();

            return response()->json([
                "res" => [
                    "msg" => "Successfully updated hotline number",
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotlines  $hotlines
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
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
                    "msg" => $validator->messages()->all()[1] ?: $validator->messages()->all()[0],
                    "status" => 400,
                ]
            ]);
        }

        $id = $request->input("id");

        try {
            //code...
            Hotlines::findOrFail($id)->delete();
            return response()->json([
                "hotlines" => Hotlines::orderBy("id", "desc")->get(),
                "res" => [
                    "msg" => "Successfully delete hotline number",
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
}
