<?php

namespace App\Http\Controllers\Government;

use App\Models\Government\Hotlines;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return response()->json(Hotlines::all());
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
     * @param  \App\Models\Hotlines  $hotlines
     * @return \Illuminate\Http\Response
     */
    public function show(Hotlines $hotlines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotlines  $hotlines
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotlines $hotlines)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotlines  $hotlines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotlines $hotlines)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotlines  $hotlines
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotlines $hotlines)
    {
        //
    }
}
