<?php

namespace App\Http\Controllers\Government;

use App\Models\Government\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $id = $request->only("id")["id"];

        try {
            News::where('id', $id)->delete();
            return response()->json([ "news" => News::all(), "res" => [ "msg" => "Successfully deleted a news", "status" => 200 ]]);
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
