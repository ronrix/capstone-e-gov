<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    /**
     * get all the application forms and send the client
     *
     * @return \Illuminate\Http\Response
     */
    public function getApplicationForms()
    {
        return response()->json(["application_forms" => Files::where("filetype", "=", "application form")->get()]);
    }

    /**
     * get all the application forms and send the client
     *
     * @return \Illuminate\Http\Response
     */
    public function getDisclosureReports()
    {
        return response()->json(["full_disclosure" => Files::where("filetype", "=", "full disclosure report")->get()]);
    }

    public function saveFile(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "filename" => "required",
            "filetype" => "required",
            "file.*" => "required|mimes:pdf,doc,docx|max:10000", # 10mb is the max 
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
                ], 400
            ]);
        }

        try {
            $files = new Files;

            if ($request->file("file")) {
                // save all the images
                $file = $request->file("file");
                $filename = str_replace(" ", "-", $request->input("filename")) . "." . strtolower($file->getClientOriginalExtension());

                $files->filename = $filename; // save the filename to save later

                # get the file type [application form, full disclosure reports]
                $path = "";
                if ($request->input("filetype") == "af") { # for application form
                    $path = "uploads/files/application-form/";
                    $files->filetype = "application form"; // save the filetype of this file

                    # create a folder if not exists before saving the image
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                } else { # for full disclosure reports
                    $path = "uploads/files/full-disclosure/";
                    $files->filetype = "full disclosure report"; // save the filetype of this file

                    # create a folder if not exists before saving the image
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                }
                $file->move(public_path($path), $filename); // move the file to the $path
                $files->filepath = $path . $filename; // save the path after uploading or saving the file to the directory
                $files->save(); // save all the columns to the DB
            }

            // return data based on the file type
            if ($request->input("filetype") == "af") { # application form data
                return response()->json([
                    "application_forms"  => Files::where("filetype", "=", "application form")->get(),
                    "res" => [
                        "msg" => "Successfully saved new file",
                        "status" => 200
                    ], 200
                ]);
            }
            return response()->json([ # full disclosure report data
                "full_disclosure"  => Files::where("filetype", "=", "full disclosure report")->get(),
                "res" => [
                    "msg" => "Successfully saved new file",
                    "status" => 200
                ], 200
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    /*
    * this will delete (soft delete) the file
    */
    public function delete(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "filetype" => "required",
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
                ], 400
            ]);
        }

        try {
            Files::findOrFail($request->input("id"))->delete();

            // return data based on the file type
            if ($request->input("filetype") == "af") { # application form data
                return response()->json([
                    "application_forms"  => Files::where("filetype", "=", "application form")->get(),
                    "res" => [
                        "msg" => "Successfully saved new file",
                        "status" => 200
                    ], 200
                ]);
            }
            return response()->json([ # full disclosure report data
                "full_disclosure"  => Files::where("filetype", "=", "full disclosure report")->get(),
                "res" => [
                    "msg" => "Successfully saved new file",
                    "status" => 200
                ], 200
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    /*
    * when this method invoked, it will get the file and download it for the user who requests
    */
    public function download(string $file)
    {
        $filename = explode("_", $file)[1];
        $directory = explode("_", $file)[0];

        $file_path = "uploads/files/$directory/$filename";

        if (!file_exists($filename)) {
            Log::debug("File doesn't exists: " . $file);
        }

        // uploads\files\full-disclosure\annual-report.pdf
        $mime_type = Storage::mimeType($file_path);
        $headers = ['Content-Type' => $mime_type];
        return response()->download(public_path($file_path), $filename, $headers);
    }
}
