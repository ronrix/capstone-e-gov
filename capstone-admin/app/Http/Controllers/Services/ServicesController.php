<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    /*
    * office of the mayor
    * get all the data for scholarship program
    */
    public function getScholarshipProgram()
    {
        return response()->json(["scholarship" => Service::where("service_type", "=", "scholarship program")->get()]);
    }

    /*
    * office of the mayor
    * update one requirement
    */
    public function updateRequirement(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "rowId" => "required",
            "arrId" => "required",
            "newValue" => "required",
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

            # store the request ids to variables
            $id = $request->input("rowId");
            $arrId = $request->input("arrId");

            $service = Service::findOrFail($id);
            $service_requirements = explode(",", $service->service_requirements);
            $service_requirements[$arrId] = $request->input("newValue");
            $service->service_requirements = implode(",", $service_requirements);
            $service->save();

            return response()->json([
                "res" => [
                    "msg" => "Successfully added new requirement",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    /*
    * office of the mayor
    * create new requirement and append that to the existing requirements
    */
    public function createRequirement(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "rowId" => "required",
            "newRequirement" => "required",
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

            # store the request ids to variables
            $id = $request->input("rowId");

            $service = Service::findOrFail($id);
            $service_requirements = explode(",", $service->service_requirements);

            # appending the new requiremnts
            array_push($service_requirements, $request->input("newRequirement"));
            $service->service_requirements = implode(",", $service_requirements);
            $service->save();

            return response()->json([
                'scholarship' => Service::where("service_type", "=", "scholarship program")->get(),
                "res" => [
                    "msg" => "Successfully added new requirement",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    /*
    * office of the mayor
    * create new requirement and append that to the existing requirements
    */
    public function deleteRequirement(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "rowId" => "required",
            "arrId" => "required",
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

            # store the request ids to variables
            $id = $request->input("rowId");
            $arrId = $request->input("arrId");

            $service = Service::findOrFail($id);
            $service_requirements = explode(",", $service->service_requirements);
            unset($service_requirements[$arrId]);
            $service->service_requirements = implode(",", $service_requirements);
            $service->save();

            return response()->json([
                'scholarship' => Service::where("service_type", "=", "scholarship program")->get(),
                "res" => [
                    "msg" => "Successfully delete requirement",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }
}
