<?php

namespace App\Http\Controllers\Government;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Government\Ordinances;
use Illuminate\Support\Facades\Validator;

class OrdinancesController extends Controller
{
    //
    public function getOrdinances()
    {
        return response()->json(["ordinances" => Ordinances::all()]);
    }

    /*
    * updatex
    */
    public function updateOrdinance(Request $request)
    {
        // get the passed parameter id
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "title" => "required",
            "pdfFile" => "mimes:pdf,doc,docx|max:10000", # 10mb is the max 
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
            $ordinance = Ordinances::findOrFail($request->input("id"));
            $ordinance->title = strtolower($request->input("title"));

            if ($request->file("pdfFile")) {
                // save all the images
                $file = $request->file("pdfFile");
                $filename = uniqid() . "." . strtolower($file->getClientOriginalExtension());
                $path = "uploads/files/ordinances/";

                # create a folder if not exists before saving the image
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file->move(public_path($path), $filename); // move the file to the $path
                $ordinance->pdf_path = $path . $filename; // save the path after uploading or saving the file to the directory
            }
            $ordinance->save(); // save all the columns to the DB

            # return all the trashed data
            return response()->json(["ordinances" => Ordinances::all(), "res" => ["msg" => "successfully updated ordinance", "status" => 200]], 200);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    function deleteOrdinance(Request $request)
    {
        // get the passed parameter id
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
            Ordinances::findOrFail($request->input("id"))->delete();
            # return all the trashed data
            return response()->json(["ordinances" => Ordinances::all(), "res" => ["msg" => "successfully updated ordinance", "status" => 200]], 200);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    // get all the trashed data
    public function getAllTrashedOrdinances()
    {
        try {
            $ordinances = Ordinances::onlyTrashed()->get();
            if ($ordinances) {
                return response()->json(["ordinances" => $ordinances]);
            }
            return response()->json(["msg" => "No trashed data", "status" => 404], 404);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    // add new ordinance data
    public function addOrdinance(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "pdfFile" => "mimes:pdf,doc,docx|max:10000", # 10mb is the max 
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
            $ordinance = new Ordinances;
            $ordinance->title = $request->input("title");

            if ($request->file("pdfFile")) {
                // save all the images
                $file = $request->file("pdfFile");
                $filename = uniqid() . "." . strtolower($file->getClientOriginalExtension());
                $path = "uploads/files/ordinances/";

                # create a folder if not exists before saving the image
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file->move(public_path($path), $filename); // move the file to the $path
                $ordinance->pdf_path = $path . $filename; // save the path after uploading or saving the file to the directory
            }
            $ordinance->save(); // save all the columns to the DB

            # return all the trashed data
            return response()->json(["ordinances" => Ordinances::all(), "res" => ["msg" => "successfully updated ordinance", "status" => 200]], 200);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }
}
