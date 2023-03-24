<?php

namespace App\Http\Controllers\Government;

use App\Http\Controllers\Controller;
use App\Models\Government\ProgramsEvents;
use Illuminate\Http\Request;

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
            ProgramsEvents::where('id', $id)->delete();
            return response()->json([ "programsEvents" => ProgramsEvents::all(), "res" => [ "msg" => "Successfully deleted a news", "status" => 200 ]]);
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
    public function update(Request $request, ProgramsEvents $programsEvents)
    {
        //
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
