<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view("pages.login");
    }

    // login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withInput($request->only("email"))->withErrors([
            'msg' => 'The provided credentials are incorrect.'
        ]);
    }

    // show the dashboard page
    public function dashboard()
    {
        return view("pages.dashboard");
    }
}
