<?php

namespace App\Http\Controllers;

use App\Events\PostRequestNotification;
use App\Models\Business\Business;
use App\Models\Government\JobPosting;
use App\Models\RequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class RequestNotificationController extends Controller
{
    # get all the notifications
    public function getNotifications()
    {
        return response()->json(["notifications" => RequestNotification::all()]);
    }

    # this is a function to update the status of notification to false
    public function notifyStatus(int $id)
    {
        try {
            $notification = RequestNotification::findOrFail($id);
            $notification->status = false;
            $notification->save();

            return response()->json(["notifications" => RequestNotification::all(), "res" => ["msg" => "successfully updated the status of notification", "status" => 200]], 200);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    public function eventHandler(Request $request)
    {
        // validate
        $validator = Validator::make($request->only([
            'author',
            'email',
            'typeOfRequest',
            'data',
            'imgs',
            'proofFiles',
        ]), [
            "author" => "required",
            "email" => "required|email",
            "typeOfRequest" => "required",
            "data" => "required|array",
            "proofFiles" => "required|mimes:pdf,doc,docx|max:10000", # 10mb is the max 
            "imgs" => "required|array",
            "imgs.*" => "nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000", # 5mb is the max 
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
            $form = [
                "author" => $request->input("author"),
                "email" => $request->input("email"),
                "type_of_request" => $request->input("typeOfRequest"),
                "data" => $request->input("data"),
            ];

            /* 
        * TODO: before sending the event, store the formData to the requestNotification table
        */
            $request_post = new RequestNotification;
            $request_post->author = $form["author"];
            $request_post->email = $form["email"];
            $request_post->type_of_request = $form["type_of_request"];
            $request_post->data = json_encode($form["data"]);
            $new_data = $form["data"];

            // store the images
            if ($request->file("imgs")) {
                // save all the images
                $img_paths = [];
                foreach ($request->file('imgs') as $file) {
                    $filename = uniqid() . "." . $file->getclientoriginalextension();
                    $path = "uploads/notifications/" . $filename;

                    # create a folder if not exists before saving the image
                    $folder = "uploads/notifications/";
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }

                    Image::make($file)->save(public_path($path)); // save the file image
                    array_push($img_paths, $path);
                }

                $new_data["imgs"] = $img_paths;
            }

            // store the pd files
            if ($request->file("proofFiles")) {
                // save all the images
                $file = $request->file("proofFiles");
                $filename = $file->getClientOriginalName();

                # get the file type [application form, full disclosure reports]
                $path = "uploads/files/notifications/";
                # create a folder if not exists before saving the image
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file->move(public_path($path), $filename); // move the file to the $path
                $new_data["proofFiles"] = $path . $filename;
            }

            $form["data"] = $new_data;
            $request_post->data = json_encode($new_data);
            $request_post->save(); // save all the columns to the DB

            $form["id"] = $request_post->id; # store the id of the row too to include on the response
            $form["status"] = true; # store the id of the row too to include on the response
            event(new PostRequestNotification($form));
            return response()->json(["res" => ["msg" => "Successfully submitted a request", "status" => 200]], 200); // send the $forms;
        } catch (\Throwable $err) {
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    # TODO: function to decline the request post will remove/delete the row data from the requestNotification table
    public function declineRequest(int $id)
    {
        try {
            // get the data first
            $notification = RequestNotification::findOrFail($id);
            // delete the images and pdf files
            $data = json_decode($notification->data);
            foreach ($data->imgs as $img) {
                $image_path = public_path($img);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            // foreach ($data->proofFiles as $file) { # pdf files
            $file_path = public_path($data->proofFiles);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            // }
            // delete the row
            $notification->delete();
            return response()->json(["notifications" => RequestNotification::all(), "res" => ["msg" => "successfully declining the request", "status" => 200]], 200);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }

    # TODO: function to accept the request post will add data data to the requestNotification table. after, will send a message to the given email
    public function acceptRequest(int $id)
    {
        try {
            $notification = RequestNotification::findOrFail($id);
            $data = json_decode($notification->data);

            // check for the type of request so we can store the data to their respective table
            if ($notification->type_of_request == "business") { # business table
                $business = new Business;
                $business->title = $data->companyName;
                $business->authors = $notification->author;
                $business->description = $data->description;
                $business->category = $data->category;
                $business->location = $data->location;
                $business->img_link = implode(", ", ($data->imgs));
                $business->save();
            } else {
                $job = new JobPosting;
                $job->logo = implode(",", $data->imgs);
                $job->author = $notification->author;
                $job->company_name = strtolower($data->companyName);
                $job->email = $notification->email;
                $job->job_title = strtolower($data->title);
                $job->job_location = strtolower($data->location);
                $job->job_description = strtolower($data->description);
                $job->job_salary = $data->salary;
                $job->job_schedule = implode(",", $data->schedules);
                $job->save();
            }

            $notification->delete(); # then delete the data from the RequestNotification table

            return response()->json(["notifications" => RequestNotification::all(), "res" => ["msg" => "successfully accepted the request", "status" => 200]], 200);
        } catch (\Throwable $err) {
            //throw $th;
            return response()->json(["res" => ["msg" => $err->getMessage(), "status" => 400]], 400);
        }
    }
}
