<?php

namespace App\Http\Controllers\Government;

use App\Models\Government\Executives;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExecutivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return response()->json(Executives::all());
        return inertia("Majn");
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
     * @param  \App\Models\Executives  $executives
     * @return \Illuminate\Http\Response
     */
    public function show(Executives $executives)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Executives  $executives
     * @return \Illuminate\Http\Response
     */
    public function edit(Executives $executives)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Executives  $executives
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Executives $executives)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Executives  $executives
     * @return \Illuminate\Http\Response
     */
    public function destroy(Executives $executives)
    {
        //
    }
}
