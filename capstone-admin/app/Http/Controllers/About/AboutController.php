<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use App\Models\About\Contact;
use App\Models\About\OfficialSeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class AboutController extends Controller
{
    /*
    * get official seal
    */
    public function getOfficialSeal(Request $request)
    {
        return response()->json(["official_seal" => OfficialSeal::all()]);
    }

    /*
    * get contacts
    */
    public function getContacts(Request $request)
    {
        return response()->json(["contacts" => Contact::all()]);
    }

    /*
    * update official seal data
    */
    public function saveSymbolImg(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "newImg" => "nullable|image|mimes:jpg,png,jpeg,gif,svg", # 5mb is the max 
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
            ]);
        }

        // get the passed parameter id
        $id = $request->input("id");

        try {

            $official_seal = OfficialSeal::findOrFail($id);

            if ($request->file("newImg")) {

                $file = $request->file("newImg");
                // save the image
                $filename = uniqid() . "." . $file->getClientOriginalExtension();
                $path = "uploads/official-seal/" . $filename;
                # create a folder if not exists
                $folder = "uploads/official-seal/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                Image::make($file)->save(public_path($path)); // save the file image
                $official_seal->symbol_logo_img_link = $path;
            }

            # save updated data
            $official_seal->save();

            return response()->json([
                "official_seal" => OfficialSeal::all(),
                "res" => [
                    "msg" => "Successfully saving new symbol image",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]]);
        }
    }


    /*
    * update official seal data
    */
    public function updateOfficialSeal(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "arrId" => "required",
            "title" => "required",
            "description" => "required",
            "newImg" => "nullable|image|mimes:jpg,png,jpeg,gif,svg", # 5mb is the max 
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
            ]);
        }

        // get the passed parameter id
        $id = $request->input("id");

        try {

            # store inputs on a variable
            $arrId = $request->input("arrId");

            $official_seal = OfficialSeal::findOrFail($id);
            $logos = json_decode($official_seal->logo, true);
            $logos[$arrId]["title"] = $request->input("title");
            $logos[$arrId]["description"] = $request->input("description");

            if ($request->file("newImg")) {

                $file = $request->file("newImg");
                // save the image
                $filename = uniqid() . "." . $file->getClientOriginalExtension();
                $path = "uploads/official-seal/" . $filename;
                # create a folder if not exists
                $folder = "uploads/official-seal/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                Image::make($file)->save(public_path($path)); // save the file image

                $logos[$arrId]["img_link"] = $path;
            }

            # save updated data
            $official_seal->logo = $logos;
            $official_seal->save();

            return response()->json([
                "official_seal" => OfficialSeal::all(),
                "res" => [
                    "msg" => "Successfully updated offical seal",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]]);
        }
    }

    /*
    * update contacts
    */
    public function updateContacts(Request $request)
    {
        return response()->json(["contacts" => Contact::all()]);
    }

    /*
    * adding new official seal
    */
    public function createOfficialSeal(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "title" => "required",
            "description" => "required",
            "newImg" => "required|image|mimes:jpg,png,jpeg,gif,svg", # 5mb is the max 
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
            ]);
        }

        try {
            $id = $request->input("id");

            $official_seal = OfficialSeal::findOrFail($id);
            $logo = [
                'title' => $request->input("title"),
                'description' => $request->input("description"),
            ];

            if ($request->file("newImg")) {
                $file = $request->file("newImg");
                // save the image
                $filename = uniqid() . "." . $file->getClientOriginalExtension();
                $path = "uploads/official-seal/" . $filename;
                # create a folder if not exists
                $folder = "uploads/official-seal/";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                Image::make($file)->save(public_path($path)); // save the file image
                $logo["img_link"] = $path;
            }

            # save created new data
            $logos = json_decode($official_seal->logo, true);
            array_push($logos, $logo);
            $official_seal->logo = $logos;
            $official_seal->save();

            return response()->json([
                "official_seal" => OfficialSeal::all(),
                "res" => [
                    "msg" => "Successfully created new offical seal",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]]);
        }
    }

    /*
    *  adding new contact
    */
    public function createContact(Request $request)
    {
        return response()->json(["contacts" => Contact::all()]);
    }

    /*
    * delete official seal
    */
    public function deleteOfficialSeal(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            "id" => "required",
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
            ]);
        }

        // get the passed parameter id
        $id = $request->input("id");

        try {

            # store inputs on a variable
            $arrId = $request->input("arrId");

            $official_seal = OfficialSeal::findOrFail($id);
            $logos = json_decode($official_seal->logo, true);
            unset($logos[$arrId]);
            # save updated data
            $official_seal->logo = $logos;
            $official_seal->save();

            return response()->json([
                "official_seal" => OfficialSeal::all(),
                "res" => [
                    "msg" => "Successfully delete an offical seal",
                    "status" => 200
                ]
            ]);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]]);
        }
    }

    /*
    * delete contact
    */
    public function deleteContact(Request $request)
    {
        return response()->json(["contacts" => Contact::all()]);
    }
}
