<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{

    public function index()
    {
        return view("pages.login");
    }

    // login
    public function login()
    {
        ddd(request());
    }
}
