<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business\Permit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['permits' => Permit::orderBy("created_at", "desc")->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business\Permit  $permit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "tableId" => "required|int",
            "title" => "required",
            "description" => "required",
            "requirements" => "required",
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
            ], 400);
        }

        try {

            # store the request ids to variables
            $id = $request->input("tableId");

            $permit = Permit::findOrFail($id);
            $permit->title = $request->input("title");
            $permit->description = $request->input("description");
            $permit->requirements = $request->input("requirements");
            $permit->save();

            return response()->json([
                'permits' => Permit::orderBy("created_at", "desc")->get(),
                "res" => [
                    "msg" => "Successfully updated the permit",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    // delete the whole permit
    public function deletePermit(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "tableId" => "required|int",
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
            ], 400);
        }

        try {

            # store the request ids to variables
            $id = $request->input("tableId");

            Permit::findOrFail($id)->delete();
            return response()->json([
                'permits' => Permit::orderBy("created_at", "desc")->get(),
                "res" => [
                    "msg" => "Successfully delete the permit",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    /*
    * this is the function for adding new permit
    */
    public function create(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "description" => "required",
            "requirements" => "required",
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
            ], 400);
        }

        try {

            # store the request ids to variables

            $permit = new Permit;
            $permit->title = $request->input("title");
            $permit->description = $request->input("description");
            $permit->requirements = $request->input("requirements");
            $permit->save();

            return response()->json([
                'permits' => Permit::orderBy("created_at", "desc")->get(),
                "res" => [
                    "msg" => "Successfully added new requirement",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }
}
