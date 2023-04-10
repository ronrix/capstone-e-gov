<?php

namespace App\Http\Controllers\Services\Agriculture;

use App\Http\Controllers\Controller;
use App\Models\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CapacityBuildingEnhancementTraining extends Controller
{
    /*
    * mswd
    * get all the data for government id
    */
    public function index()
    {
        return response()->json(["capacity_building" => Service::where("service_type", "=", "capacity building enhancement training")->get()]);
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
                'capacity_building' => Service::where("service_type", "=", "capacity building enhancement training")->get(),
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
    * delete one requirement
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
                "capacity_building" => Service::where("service_type", "=", "capacity building enhancement training")->get(),
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

    /*
    * office of the mayor
    * update one process
    */
    public function updateProcess(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "rowId" => "required",
            "arrId" => "required",
            "newValue" => "required",
            "key" => "required",
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
            $key = $request->input("key");

            $service = Service::findOrFail($id);
            $service_process = json_decode($service->service_process, true);
            $service_process[$arrId][$key] = $request->input("newValue");
            $service->service_process = json_encode($service_process);
            $service->save();

            return response()->json([
                "res" => [
                    "msg" => "Successfully updated process",
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
    * delete one process
    */
    public function deleteProcess(Request $request)
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
            $service_process = json_decode($service->service_process, true);
            unset($service_process[$arrId]);
            $service->service_process = json_encode($service_process);
            $service->save();

            return response()->json([
                "capacity_building" => Service::where("service_type", "=", "capacity building enhancement training")->get(),
                "res" => [
                    "msg" => "Successfully delete process",
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
    public function createProcess(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "rowId" => "required",
            "client_steps" => "required",
            "agent_steps" => "required",
            "fees" => "required",
            "process_time" => "required",
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

            $id = $request->input("rowId");

            $service = Service::findOrFail($id);
            $service_process = json_decode($service->service_process, true);

            $new_process = [
                "client_steps" => $request->input("client_steps"),
                "agent_steps" => $request->input("agent_steps"),
                "fees" => $request->input("fees"),
                "process_time" => $request->input("process_time"),
            ];
            array_push($service_process, $new_process); # append the new process
            $service->service_process = $service_process;
            $service->save();

            return response()->json([
                "capacity_building" => Service::where("service_type", "=", "capacity building enhancement training")->get(),
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
}
