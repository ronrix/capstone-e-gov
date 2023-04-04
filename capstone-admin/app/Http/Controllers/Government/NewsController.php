<?php

namespace App\Http\Controllers\Government;

use App\Models\Government\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image, File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return response()->json(News::all());
        return inertia("Main");
    }

    public function getNews()
    {
        //
        // return response()->json(News::all());
        return response()->json(["news" => News::all()]);
    }

    public function deleteOneNews(Request $request)
    {
        // get the passed parameter id
        $request->validate(["id" => ["required"]]);
        $id = $request->input("id");

        try {
            News::findOrFail($id)->delete();
            return response()->json(["news" => News::all(), "res" => ["msg" => "Successfully deleted a news", "status" => 200]]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["res" => ["msg" => $th, "status" => 400]]);
        }
    }

    public function editNews(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "title" => "required",
            "description" => "required",
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
            $news = News::findOrFail($id);
            $news->title = $request->input("title");
            $news->description = $request->input("description");

            if ($request->file("newImgs")) {

                // save all the images
                $imgPaths = [];
                $imgs = explode(",", $news->img_link);
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

                $news->img_link = implode(",", $imgs);
                $news->save();
            } else { # if the image is null then only update the title and description

                $imgs = explode(",", $news->img_link);
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

                $news->img_link = implode(",", $imgs);
                $news->save();
            }

            return response()->json([
                "news" => News::all(),
                "res" => [
                    "msg" => "Successfully updated news",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]]);
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
            if ($request->file("imgFile")) {
                // save all the images
                $imgPaths = [];
                foreach ($request->file('imgFile') as $file) {
                    $filename = uniqid() . "." . $file->getClientOriginalExtension();
                    $path = "uploads/" . $filename;
                    Image::make($file)->save(public_path($path)); // save the file image
                    array_push($imgPaths, $path);
                }

                $news = new News;
                $news->title = $request->input("title");
                $news->description = $request->input("description");
                $news->img_link = implode(",", $imgPaths);
                $news->save();
            }

            return response()->json([
                "news" => News::all(),
                "res" => [
                    "msg" => "Successfully created news",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]]);
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
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
