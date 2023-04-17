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
        return response()->json(["programsEvents" => ProgramsEvents::orderBy("created_at", "desc")->get()]);
    }

    public function deleteOne(Request $request)
    {
        // get the passed parameter id
        $request->validate(["id" => ["required"]]);
        $id = $request->input("id");

        try {
            ProgramsEvents::findOrFail($id)->delete();
            return response()->json(["programsEvents" => ProgramsEvents::orderBy("created_at", "desc")->get(), "res" => ["msg" => "Successfully deleted a programsEvents", "status" => 200]], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["res" => ["msg" => $th, "status" => 400]], 400);
        }
    }

    /*
    * get all trashed data
    */
    public function getAllTrashed(Request $request)
    {
        try {
            $programs_events = ProgramsEvents::onlyTrashed()->get();
            if ($programs_events) {
                return response()->json(["programsEvents" => $programs_events]);
            }
            return response()->json(["msg" => $programs_events, "status" => 404], 404);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    /*
    * restore trashed data
    */
    public function restore(Request $request)
    {
        // get the passed parameter id
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
            ], 400);
        }

        $id = $request->input("id");
        try {
            ProgramsEvents::withTrashed()->find($id)->restore();

            # return all the trashed data
            return response()->json(["programsEvents" => ProgramsEvents::onlyTrashed()->get(), "res" => ["msg" => "successfully restore data", "status" => 200]], 200);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
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
            "authors" => "required",
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
            ], 400);
        }

        try {
            if ($request->file("imgFile")) {
                // save all the images
                $imgPaths = [];
                foreach ($request->file('imgFile') as $file) {
                    $filename = uniqid() . "." . $file->getClientOriginalExtension();
                    $path = "uploads/programs-events/" . $filename;

                    # create a folder if not exists before saving the image
                    $folder = "uploads/programs-events/";
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }

                    Image::make($file)->save(public_path($path)); // save the file image
                    array_push($imgPaths, $path);
                }

                $programsEvents = new ProgramsEvents;
                $programsEvents->title = $request->input("title");
                $programsEvents->authors = $request->input("authors");
                $programsEvents->description = $request->input("description");
                $programsEvents->location = $request->input("location");
                $programsEvents->img_link = implode(",", $imgPaths);
                $programsEvents->save();
            }

            return response()->json([
                "programsEvents" => ProgramsEvents::orderBy("created_at", "desc")->get(),
                "res" => [
                    "msg" => "Successfully created programsEvents",
                    "status" => 200
                ]
            ], 200);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
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
            "authors" => "required",
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
            ], 400);
        }

        // get the passed parameter id
        $id = $request->input("id");

        try {
            $programsEvents = ProgramsEvents::findOrFail($id);
            $programsEvents->title = $request->input("title");
            $programsEvents->auhors = $request->input("authors");
            $programsEvents->description = $request->input("description");
            $programsEvents->location = $request->input("location");

            if ($request->file("newImgs")) {

                // save all the images
                $imgPaths = [];
                $imgs = explode(",", $programsEvents->img_link);
                foreach ($request->file('newImgs') as $file) {
                    $filename = uniqid() . "." . $file->getClientOriginalExtension();
                    $path = "uploads/programs-events/" . $filename;

                    # create a folder if not exists before saving the image
                    $folder = "uploads/programs-events/";
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }

                    Image::make($file)->save(public_path($path)); // save the file image
                    array_push($imgPaths, $path);
                }

                # merge the $imgs and the newly uploaded img paths
                $imgs = array_merge($imgs, $imgPaths);

                # check if there is imgs to delete
                # delete the img and set the default thumbnail using the provided defaultThumbnailId
                if ($request->input("deletedImgs") && count($request->input("deletedImgs"))) {
                    // format the img_links
                    // delete the img_link with the provided deleted ids, and put the selected id to the first index
                    foreach ($request->input("deletedImgs") as $toDel) {
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
                if ($request->input("deletedImgs") && count($request->input("deletedImgs"))) {
                    // format the img_links
                    // delete the img_link with the provided deleted ids, and put the selected id to the first index
                    foreach ($request->input("deletedImgs") as $toDel) {
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
                "programsEvents" => ProgramsEvents::orderBy("created_at", "desc")->get(),
                "res" => [
                    "msg" => "Successfully updated programs and events",
                    "status" => 200
                ]
            ], 200);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }
}
