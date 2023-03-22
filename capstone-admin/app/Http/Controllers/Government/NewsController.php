<?php

namespace App\Http\Controllers\Government;

use App\Models\Government\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        return response()->json([ "news" => News::all()]);
    }

    public function deleteOneNews(Request $request) {
        // get the passed parameter id
        $request->validate(["id" => ["required"]]);
        $id = $request->input("id");

        try {
            News::where('id', $id)->delete();
            return response()->json([ "news" => News::all(), "res" => [ "msg" => "Successfully deleted a news", "status" => 200 ]]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([ "res" => ["msg" => $th, "status" => 400 ]]);
        }
    }

    public function editNews(Request $request) {
        // validate
        $request->validate([
            "id" => "required", 
            "title" => "required", 
            "description" => "required", 
            "imgFile" => "nullable|image|mimes:jpg,png,jpeg,gif,svg" # 5mb is the max 
        ]);

        // get the passed parameter id
        $id = $request->input("id");

        try {
            if($request->file("imgFile")) {
                $file = $request->file("imgFile");

                $filename = uniqid() . "." . $file->getClientOriginalExtension();
                $path = "uploads/" .$filename;
                Image::make($file)->save(public_path($path)); // save the file image
               
                $news = News::findOrFail($id);
                $news->title = $request->input("title");
                $news->description = $request->input("description");
                $news->img_link = $path;
                $news->save();
            } else { # if the image is null then only update the title and description
                $news = News::findOrFail($id);
                $news->title = $request->input("title");
                $news->description = $request->input("description");
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
            return response()->json([ "res" => ["msg" => $err->getMessage(), "status" => 400 ]]);
        }
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
