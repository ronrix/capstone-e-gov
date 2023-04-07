<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business\Permit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['permits' => Permit::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business\Permit  $permit
     * @return \Illuminate\Http\Response
     */
    public function updatePermitTitle(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required|int",
            "newTitle" => "required",
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

        # store permit id to a variable
        $id = $request->input("id");

        try {
            $permit = Permit::findOrFail($id);
            $permit->title = $request->input("newTitle");
            $permit->save();

            return response()->json([
                "res" => [
                    "msg" => "Successfully updated then permit",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business\Permit  $permit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "tableId" => "required|int",
            "perId" => "required|int",
            "reqId" => "nullable|int",
            "newValue" => "required",
            "isReq" => "required|boolean",
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
            $id = $request->input("tableId");
            $perId = $request->input("perId");
            $reqId = $request->input("reqId");

            $permit = Permit::findOrFail($id);
            $requirements = json_decode($permit->requirements, true);

            if ($request->input("isReq")) {
                $reqs = array_values($requirements);
                $reqs[$perId][$reqId] = $request->input("newValue");
                $newRequirements = array_combine(array_keys($requirements), $reqs);
            } else {
                $reqs = array_keys($requirements);
                $reqs[$perId] = $request->input("newValue");
                $newRequirements = array_combine($reqs, array_values($requirements));
            }

            $permit->requirements = json_encode($newRequirements);
            $permit->save();

            return response()->json([
                "res" => [
                    "msg" => "Successfully updated the permit",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    public function saveNewRequirement(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "tableId" => "required|int",
            "perId" => "required|int",
            "value" => "required",
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
            $id = $request->input("tableId");
            $perId = $request->input("perId");

            $permit = Permit::findOrFail($id);
            $requirements = json_decode($permit->requirements, true);
            $reqs = array_values($requirements);
            array_push($reqs[$perId], $request->input("value"));
            $newRequirements = array_combine(array_keys($requirements), $reqs);

            $permit->requirements = json_encode($newRequirements);
            $permit->save();

            return response()->json([
                'permits' => Permit::all(),
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

    // delete the whole permit
    public function deletePermit(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "tableId" => "required|int",
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
            $id = $request->input("tableId");

            Permit::findOrFail($id)->delete();
            return response()->json([
                'permits' => Permit::all(),
                "res" => [
                    "msg" => "Successfully delete the permit",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    // delete the whole permit
    public function deleteSectionPermit(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "tableId" => "required|int",
            "permitKey" => "required",
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
            $id = $request->input("tableId");
            $permitKey = $request->input("permitKey");

            $permit = Permit::findOrFail($id);
            $requirements = json_decode($permit->requirements, true);
            unset($requirements[$permitKey]);
            $permit->requirements = json_encode($requirements);
            $permit->save();

            return response()->json([
                'permits' => Permit::all(),
                "res" => [
                    "msg" => "Successfully delete one section of permit",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    // delete the whole permit
    public function deleteOneReq(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "tableId" => "required|int",
            "permitKey" => "required",
            "reqId" => "required",
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
            $id = $request->input("tableId");
            $permitKey = $request->input("permitKey");
            $reqId = $request->input("reqId");

            $permit = Permit::findOrFail($id);
            $requirements = json_decode($permit->requirements, true);
            unset($requirements[$permitKey][$reqId]);
            $permit->requirements = json_encode($requirements);
            $permit->save();

            return response()->json([
                'permits' => Permit::all(),
                "res" => [
                    "msg" => "Successfully delete one section of permit",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }
}
