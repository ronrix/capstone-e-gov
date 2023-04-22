<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{

    public function index()
    {
        // rediect the user to the dashboard if they are already logged in
        if (Auth::check()) {
            return redirect("/dashboard");
        }

        return inertia("Login", [
            "title" => "Login"
        ]);
    }

    // login
    public function login(Request $request)
    {

        // validating the inputs
        $request->validate(["email" => ["required"], "password" => ["required"]]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $remember = true)) {
            // Authentication passed...
            // return redirect()->intended('dashboard');
            return response()->json(["msg" => "success", "status" => 200]);
        }

        // return error message in objects
        // return redirect()->route('login.index')->with('error_msg', ["msg" => 'Invalid username or password', "status" => 400]);
        return response()->json(["msg" => 'Invalid username or password', "status" => 400]);
    }

    // change password
    public function changePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        #Match The Old Password
        if (!Hash::check($request->currentPassword, auth()->user()->password)) {
            return response()->json(["res" => ["msg" => "Old Password Doesn't match!", "status" => 403]], 403);
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->newPassword)
        ]);


        return response()->json(["res" => ["msg" => "Password changed successfully", "status" => 200]], 200);
    }

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


    // show the dashboard page
    public function dashboard()
    {
        // add logo image to response
        $assetUrl = asset('images/logo/pililla-logo.png');
        return inertia("Main", ["assetUrl" => $assetUrl]);
    }
}
