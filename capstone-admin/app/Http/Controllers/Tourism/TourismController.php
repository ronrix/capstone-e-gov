<?php

namespace App\Http\Controllers\Tourism;

use App\Http\Controllers\Controller;
use App\Models\Tourism\Tourism;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class TourismController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(['tourism' => Tourism::orderBy('created_at', 'desc')->get()]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "name" => "required",
            "description" => "required",
            "location" => "required",
            "img" => "nullable|image|mimes:jpg,png,jpeg,gif,svg" # 5mb is the max 
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

        // get the passed parameter id
        $id = $request->input("id");

        try {

            $tourism = Tourism::findOrFail($id);
            $tourism->name = $request->input("name");
            $tourism->description = $request->input("description");
            $tourism->location = $request->input("location");

            if ($request->file("img")) { # if there is image uploaded, then save it in public/uploads folder

                $file = $request->file("img");
                $filename = uniqid() . "." . $file->getClientOriginalExtension();
                $path = "uploads/" . $filename;
                Image::make($file)->save(public_path($path)); // save the file image

                $tourism->img_link = $path;
            }
            $tourism->save(); # then save the updated table row

            return response()->json([
                "tourism" => Tourism::orderBy('created_at', 'desc')->get(),
                "res" => [
                    "msg" => "Successfully updated tourist spot",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
