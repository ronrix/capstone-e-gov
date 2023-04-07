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

// tourism
Route::get('/tourism', function () {
    return inertia('Main');
});
Route::get('/tourist-attractions', function () {
    return inertia('Main');
});
Route::get('/festivals', function () {
    return inertia('Main');
});

// business
Route::get('/business', function () {
    return inertia('Main');
});
Route::get('/establishments', function () {
    return inertia('Main');
});
Route::get('/apartments', function () {
    return inertia('Main');
});
Route::get('/bplo', function () {
    return inertia('Main');
});

// services
Route::get('/services', function () {
    return inertia('Main');
});
Route::get('/scholarship', function () {
    return inertia('Main');
});
