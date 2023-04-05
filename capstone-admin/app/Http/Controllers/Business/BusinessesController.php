<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class BusinessesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['businesses' => Business::orderBy('created_at', 'desc')->get()]);
    }

    public function delete(Request $request)
    {
        // get the passed parameter id
        $validator = Validator::make($request->all(), ["id" => "required"]);
        /*
        * customizing the validation response
        */
        if ($validator->fails()) {
            # send the second error message if exists otherwise send the first one
            return response()->json([
                "res" => [
                    "msg" => $validator->messages()->all()[0],
                    "status" => 400,
                ]
            ], 400);
        }
        $id = $request->input("id");

        try {
            Business::findOrFail($id)->delete();
            return response()->json(["businesses" => Business::orderBy('created_at', 'desc')->get(), "res" => ["msg" => "Successfully deleted a business", "status" => 200]]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["res" => ["msg" => $th, "status" => 400]]);
        }
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
            "title" => "required",
            "description" => "required",
            "location" => "required",
            "category" => "required",
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

            $business = Business::findOrFail($id);
            $business->title = $request->input("title");
            $business->description = $request->input("description");
            $business->location = $request->input("location");
            $business->category = $request->input("category");

            if ($request->file("newImgs")) {

                // save all the images
                $imgPaths = [];
                $imgs = explode(",", $business->img_link);
                foreach ($request->file('newImgs') as $file) {
                    $filename = uniqid() . "." . $file->getClientOriginalExtension();
                    $path = "uploads/" . $filename;
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

                $business->img_link = implode(",", $imgs);
                $business->save();
            } else { # if the image is null then only update the title and description

                $imgs = explode(",", $business->img_link);
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

                $business->img_link = implode(",", $imgs);
                $business->save();
            }


            return response()->json([
                "businesses" => Business::orderBy('created_at', 'desc')->get(),
                "res" => [
                    "msg" => "Successfully updated a business establishment",
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
    public function create(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "description" => "required",
            "location" => "required",
            "category" => "required",
            "imgFile" => "required|array", # 5mb is the max 
            "imgFile.*" => "image|mimes:jpeg,png,jpg,gif,svg", # 2mb is the max 
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
                    $path = "uploads/" . $filename;
                    Image::make($file)->save(public_path($path)); // save the file image
                    array_push($imgPaths, $path);
                }

                $business = new Business;
                $business->title = $request->input("title");
                $business->description = $request->input("description");
                $business->location = $request->input("location");
                $business->category = $request->input("category");
                $business->img_link = implode(",", $imgPaths);
                $business->save();
            }

            return response()->json([
                "businesses" => Business::orderBy('created_at', 'desc')->get(),
                "res" => [
                    "msg" => "Successfully created a business establishment",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }
}
