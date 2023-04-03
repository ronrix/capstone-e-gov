<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $tz = new DateTime("now", new DateTimeZone("Asia/Manila"));
    return inertia('Main', ["time" => $tz->format("l, d F Y h:i:sA ")]);
});
