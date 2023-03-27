<?php

namespace App\Http\Controllers\Government;

use App\Http\Controllers\Controller;
use App\Models\Government\ProgramsEvents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image, File;

class ProgramsEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(["programsEvents" => ProgramsEvents::all()]);
    }

    public function deleteOne(Request $request) {
       // get the passed parameter id
        $request->validate(["id" => ["required"]]);
        $id = $request->input("id");

        try {
            ProgramsEvents::findOrFail($id)->delete();
            return response()->json([ "programsEvents" => ProgramsEvents::all(), "res" => [ "msg" => "Successfully deleted a programsEvents", "status" => 200 ]]);
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
            "title" => "required", 
            "description" => "required", 
            "location" => "required", 
            "imgFile" => "required|array", # 5mb is the max 
            "imgFile.*" => "nullable|image|mimes:jpeg,png,jpg,gif,svg", # 2mb is the max 
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
                // save all the images
                $imgPaths = [];
                foreach ($request->file('imgFile') as $file) {
                    $filename = uniqid() . "." . $file->getClientOriginalExtension();
                    $path = "uploads/" .$filename;
                    Image::make($file)->save(public_path($path)); // save the file image
                    array_push($imgPaths, $path);
                }
                
                $programsEvents = new ProgramsEvents;
                $programsEvents->title = $request->input("title");
                $programsEvents->description = $request->input("description");
                $programsEvents->location = $request->input("location");
                $programsEvents->img_link = implode(",", $imgPaths);
                $programsEvents->save();
            }     

            return response()->json([
                "programsEvents" => ProgramsEvents::all(),
                "res" => [
                    "msg" => "Successfully created programsEvents",
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
     * @param  \App\Models\Government\ProgramsEvents  $programsEvents
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramsEvents $programsEvents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Government\ProgramsEvents  $programsEvents
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramsEvents $programsEvents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Government\ProgramsEvents  $programsEvents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         // validate
        $validator = Validator::make($request->all(), [
            "id" => "required", 
            "title" => "required", 
            "description" => "required", 
            "location" => "required", 
            "deletedImgs" => "nullable|array", 
            "defaultThumbnailId" => "required", 
            "newImgs" => "nullable|array", # 5mb is the max 
            "newImgs.*" => "nullable|image|mimes:jpg,png,jpeg,gif,svg" # 5mb is the max 
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

        // get the passed parameter id
        $id = $request->input("id");

        try {
            $programsEvents = ProgramsEvents::findOrFail($id);
            $programsEvents->title = $request->input("title");
            $programsEvents->description = $request->input("description");
            $programsEvents->location = $request->input("location");

            if($request->file("newImgs")) {

                // save all the images
                $imgPaths = [];
                $imgs = explode(",", $programsEvents->img_link);
                foreach ($request->file('newImgs') as $file) {
                    $filename = uniqid() . "." . $file->getClientOriginalExtension();
                    $path = "uploads/" .$filename;
                    Image::make($file)->save(public_path($path)); // save the file image
                    array_push($imgPaths, $path);
                }

                # merge the $imgs and the newly uploaded img paths
                $imgs = array_merge($imgs, $imgPaths);

                # check if there is imgs to delete
                # delete the img and set the default thumbnail using the provided defaultThumbnailId
                if($request->input("deletedImgs") && count($request->input("deletedImgs"))) {
                    // format the img_links
                    // delete the img_link with the provided deleted ids, and put the selected id to the first index
                    foreach($request->input("deletedImgs") as $toDel) {
                        unset($imgs[$toDel]);
                    }
                }

                # remove the selected img and store to var before unshifting it to the first index
                $toBeAddedToFirstIdx = array_splice($imgs, $request->input("defaultThumbnailId"), 1);
                array_unshift($imgs, $toBeAddedToFirstIdx[0]); # add the selected img to the first index

                $programsEvents->img_link = implode(",", $imgs);
                $programsEvents->save();

            } else { # if the image is null then only update the title and description

                $imgs = explode(",", $programsEvents->img_link);
                # check if there is imgs to delete
                # delete the img and set the default thumbnail using the provided defaultThumbnailId
                if($request->input("deletedImgs") && count($request->input("deletedImgs"))) {
                    // format the img_links
                    // delete the img_link with the provided deleted ids, and put the selected id to the first index
                    foreach($request->input("deletedImgs") as $toDel) {
                        unset($imgs[$toDel]);
                    }
                }
                # remove the selected img and store to var before unshifting it to the first index
                $toBeAddedToFirstIdx = array_splice($imgs, $request->input("defaultThumbnailId"), 1);
                array_unshift($imgs, $toBeAddedToFirstIdx[0]); # add the selected img to the first index

                $programsEvents->img_link = implode(",", $imgs);
                $programsEvents->save();
            }
    
            return response()->json([
                "programsEvents" => ProgramsEvents::all(),
                "res" => [
                    "msg" => "Successfully updated programs and events",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json([ "res" => ["msg" => $err->getMessage(), "status" => 400 ]]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Government\ProgramsEvents  $programsEvents
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramsEvents $programsEvents)
    {
        //
    }
}
