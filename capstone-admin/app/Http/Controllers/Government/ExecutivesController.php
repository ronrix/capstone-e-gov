<?php

namespace App\Http\Controllers\Government;

use App\Models\Government\Executives;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
        $date_now = Carbon::now();
        
        $mayors = Executives::whereIn('position', ['Mayor', 'Vice Mayor', 'Barangay Officials'])
                       ->whereDate('start_term', '<=', $date_now)
                       ->whereDate('end_term', '>=', $date_now)
                       ->get();
        
        return response()->json(['currentOfficials' => $mayors]);
    }

    public function getFormerOfficials()
    {
        //
        $date_now = Carbon::now();
        
        $mayors = Executives::whereIn('position', ['Mayor', 'Vice Mayor', 'Barangay Official'])
                       ->whereDate('end_term', '<=', $date_now)
                       ->get();
        
        return response()->json(['formerOfficials' => $mayors]);
    }

    public function getBarangayOfficials()
    {
        //
        $date_now = Carbon::now();
        
        $mayors = Executives::where('position', 'Barangay Official')->get();
        return response()->json(['barangayOfficials' => $mayors]);
    }

    public function getDepartmentHeads()
    {
        //
        $date_now = Carbon::now();
        
        $mayors = Executives::whereIn('position', ['Agriculture', 'Treasurer', 'HR'])->get();
        return response()->json(['departmentHeads' => $mayors]);
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
