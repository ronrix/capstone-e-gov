<?php

namespace App\Http\Controllers;

use App\Models\VisitorCounter;
use Illuminate\Http\Request;

class VisitorCounterController extends Controller
{
    /* 
    * increment for today
    * increment the total_counter column too
    * 
    * this will invoked from the public website
    */
    public function incrementVisitors(Request $request)
    {
        // $visitor_id = $request->cookie('visitor_id');
        try {
            // if (!$visitor_id) {
            // Generate a new visitor ID
            $visitor_id = uniqid();


            // Create a new visitor record, if row does not exists
            $visitor = VisitorCounter::findOrCreate(1);
            $visitor->counter = $visitor->counter ? $visitor->counter + 1 : 1;
            $ids = json_decode($visitor->visitors_id);

            # check if visitors_id has data
            // if ($ids) { # append the new visitor
            array_push($ids, $visitor_id);
            $visitor->visitors_id = json_encode($ids);
            $visitor->total_visitors = count($ids);
            // } else { # add visitor for the first time
            //     $visitor->visitors_id = json_encode([$visitor_id]);
            //     $visitor->total_visitors = 1;
            // }

            $visitor->save();

            // Set the visitor ID as a cookie to track the visitor
            // return response()->json(['visitor_id' => $visitor_id, 'msg' => 'SUCCESS'], 200)->cookie('visitor_id', $visitor_id);
            // }

            // Visitor ID exists in the cookie, no need to increment the count
            return response()->json(['visitor_id' => $visitor_id, 'msg' => 'SUCCESS'], 200);
        } catch (\Throwable $err) {
            return response()->json(['error' => $err->getMessage()], 400);
        }
    }

    /* 
    * get the general total and visitors for today
    */
    public function getVisitors()
    {
        try {
            $visitors = VisitorCounter::find(['id' => 1]);
            return response()->json(['visitors' => $visitors], 200);
        } catch (\Throwable $err) {
            return response()->json(['error' => $err->getMessage()], 400);
        }
    }
}
