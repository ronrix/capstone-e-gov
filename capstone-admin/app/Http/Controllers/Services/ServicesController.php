<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{

    /*
    * delete one service
    */
    public function deleteService(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required",
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
            Service::findOrFail($request->input("id"))->delete();

            # get the updated services
            $data = Service::select("service_department", "service_type")->get();
            $json_data = json_decode($data, true);

            $grouped_data = [];

            foreach ($json_data as $service_type) {
                $department = $service_type['service_department'];
                $type = $service_type['service_type'];

                if (!isset($grouped_data[$department])) {
                    $grouped_data[$department] = [];
                }

                array_push($grouped_data[$department], $type);
            }
            return response()->json(["service_types" => $grouped_data, "res" => ["msg" => "successfully created new service", "status" => 200]], 200);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    /*
    * office of the mayor
    * create new service
    */
    public function createNewService(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "department" => "required",
            "title" => "required",
            "description" => "required",
            "serviceType" => "required",
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

            $service = new Service;
            $service->service_department = $request->input("department");
            $service->title = $request->input("title");
            $service->description = $request->input("description");
            $service->service_type = $request->input("serviceType");
            $service->save(); #save the new service

            # get the updated services
            $data = Service::select("service_department", "service_type")->get();
            $json_data = json_decode($data, true);

            $grouped_data = [];

            foreach ($json_data as $service_type) {
                $department = $service_type['service_department'];
                $type = $service_type['service_type'];

                if (!isset($grouped_data[$department])) {
                    $grouped_data[$department] = [];
                }

                array_push($grouped_data[$department], $type);
            }
            return response()->json(["service_types" => $grouped_data, "res" => ["msg" => "successfully created new service", "status" => 200]], 200);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    /*
    * office of the mayor
    * get all the service types
    */
    public function getAllServiceTypes()
    {
        $data = Service::select("service_department", "service_type")->get();
        $json_data = json_decode($data, true);

        $grouped_data = [];

        foreach ($json_data as $service_type) {
            $department = $service_type['service_department'];
            $type = $service_type['service_type'];

            if (!isset($grouped_data[$department])) {
                $grouped_data[$department] = [];
            }

            array_push($grouped_data[$department], $type);
        }
        return response()->json(["service_types" => $grouped_data]);
    }

    /*
    * office of the mayor
    * get all the data for scholarship program
    */
    public function get(string $_service)
    {
        return response()->json(["services" => Service::where("service_type", "=", str_replace("_", " ", $_service))->orWhere("title", "=", str_replace("_", " ", $_service))->get()]);
    }

    /*
    * update application form
    */
    public function updateApplicationForm(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "file" => "required|mimes:pdf,doc,docx|max:10000", # 10mb is the max 
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

            # store the request variables
            $id = $request->input("id");

            $service = Service::findOrFail($id);
            // delete the existing file and save the new file
            $path = $service->application_form;
            if (file_exists($path)) {
                unlink($path);
            }
            # create a folder if not exists before saving the image
            $folder = "uploads/files/services/";
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            if ($request->file("file")) {
                // save the images
                $file = $request->file("file");
                $filename = str_replace(" ", "-", $request->input("filename")) . "." . strtolower($file->getClientOriginalExtension());
                $file->move(public_path($folder), $filename); // move the file to the $path
                $service->application_form = $folder . $filename;
            }
            $service->save();

            return response()->json([
                "res" => [
                    "msg" => "Successfully updated the application form",
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
    * update one requirement
    */
    public function updateTitleDescription(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "newValue" => "required",
            "type" => "required",
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

            # store the request variables
            $id = $request->input("id");
            $newValue = $request->input("newValue");
            $type = $request->input("type");

            $service = Service::findOrFail($id);
            if ($type === "title") {
                $service->title =  $newValue;
            } else if ($type === "email") {
                $service->email =  $newValue;
            } else {
                $service->description =  $newValue;
            }
            $service->save();

            return response()->json([
                "res" => [
                    "msg" => "Successfully updated the data",
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
    * update one requirement
    */
    public function updateRequirement(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "rowId" => "required",
            "arrId" => "required",
            "valueId" => "required",
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
            $valueId = $request->input("valueId");
            $newValue = $request->input("newValue");

            $service = Service::findOrFail($id);
            $service_requirements = json_decode($service->service_requirements, true);
            $keys = array_keys($service_requirements);
            $values = array_values($service_requirements);
            if ($valueId == 0) { # check the keys and update the selected value
                $keys[$arrId] = $newValue;
            } else {
                $values[$arrId] = $newValue;
            }

            $service->service_requirements = array_combine($keys, $values);
            $service->save();

            return response()->json([
                "res" => [
                    "msg" => "Successfully updated requirement",
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
    public function createRequirement(Request $request, string $_service)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "rowId" => "required",
            "newRequirement" => "required",
            "newWhereToGo" => "required",
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
            $service_requirements = json_decode($service->service_requirements, true);

            # appending the new requiremnts
            # check if $service_requirements is empty
            $merged_array = [];
            if ($service_requirements) {
                $merged_array = $service_requirements + array_combine($request->input("newRequirement"), $request->input("newWhereToGo"));
                $service->service_requirements = json_encode($merged_array);
            } else {
                $service->service_requirements = array_combine($request->input("newRequirement"), $request->input("newWhereToGo"));
            }
            $service->save();

            return response()->json([
                'services' => Service::where("service_type", "=", str_replace("-", " ", $_service))->get(),
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
    public function deleteRequirement(Request $request, string $_service)
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
            $service_requirements = json_decode($service->service_requirements, true);
            $new_requirements = array_slice($service_requirements, $arrId + 1, null, true);
            $service->service_requirements = json_encode($new_requirements);
            $service->save();

            return response()->json([
                'services' => Service::where("service_type", "=", str_replace("-", " ", $_service))->get(),
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
    public function deleteProcess(Request $request, string $_service)
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
                'services' => Service::where("service_type", "=", str_replace("-", " ", $_service))->get(),
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
    public function createProcess(Request $request, string $_service)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "rowId" => "required",
            "client_steps" => "required",
            "agent_steps" => "required",
            "fees" => "required",
            "process_time" => "required",
            "person_responsible" => "required",
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
                "agency_steps" => $request->input("agent_steps"),
                "fees" => $request->input("fees"),
                "process_time" => $request->input("process_time"),
                "person_responsible" => $request->input("person_responsible"),
            ];
            # check if $service_process is empty
            if ($service_process) {
                array_push($service_process, $new_process); # append the new process
                $service->service_process = $service_process;
            } else {
                # create new process
                $service->service_process = array($new_process);
            }
            $service->save();

            return response()->json([
                'services' => Service::where("service_type", "=", str_replace("-", " ", $_service))->get(),
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
