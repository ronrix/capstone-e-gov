<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->intended('dashboard');
        }

        // return error message in objects
        return redirect()->route('login.index')->with('error_msg', ["msg" => 'Invalid username or password', "status" => 400]);
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
        return inertia("Main");
    }
}
