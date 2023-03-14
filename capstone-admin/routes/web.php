<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Government\NewsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Government\AdvisoryController;
use App\Http\Controllers\Government\HotlinesController;
use App\Http\Controllers\Government\ExecutivesController;
use App\Http\Controllers\Government\JobPostingController;
use App\Http\Controllers\Government\PopulationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return redirect("login");
});
Route::get('/login', [LoginController::class, "index"])->name("login.index");
Route::get('/logout', [LoginController::class, "logout"]);

// government
Route::middleware(["auth"])->group(function () {
    Route::get('/dashboard', [LoginController::class, "dashboard"]);
    // government
    Route::get("/government/news", [NewsController::class, "index"]);
    Route::get("/government/programs-and-events", function() {
        return inertia("Main");
    });
    Route::get("/government/current-officials", function() {
        return inertia("Main");
    });
    Route::get("/government/former-officials", function() {
        return inertia("Main");
    });
    Route::get("/government/barangay-officials", function() {
        return inertia("Main");
    });
    Route::get("/government/department-heads", function() {
        return inertia("Main");
    });
    Route::get("/government/job-postings", function() {
        return inertia("Main");
    });
    Route::get("/government/office-of-the-mayor", function() {
        return inertia("Main");
    });
    Route::get("/government/full-disclosure-reports", function() {
        return inertia("Main");
    });
    Route::get("/government/hotlines", function() {
        return inertia("Main");
    });
    Route::get("/government/population", function() {
        return inertia("Main");
    });

    // tourism
    Route::get("/tourism/tourism", function() {
        return inertia("Main");
    });
    Route::get("/tourism/tourist-spots", function() {
        return inertia("Main");
    });
    Route::get("/tourism/festivals", function() {
        return inertia("Main");
    });
    Route::get("/tourism/guidelines", function() {
        return inertia("Main");
    });

    // businesses
    Route::get("/businesses/apartments", function() {
        return inertia("Main");
    });
    Route::get("/businesses/permit-form", function() {
        return inertia("Main");
    });
    Route::get("/businesses/ease-of-doing-business", function() {
        return inertia("Main");
    });

    // services
    Route::get("/services/office-of-the-mayor/example", function() {
        return inertia("Main");
    });

    // about
    Route::get("/about/mission-and-vision", function() {
        return inertia("Main");
    });
    Route::get("/about/history", function() {
        return inertia("Main");
    });
    Route::get("/about/official-seal", function() {
        return inertia("Main");
    });
    Route::get("/about/contacts", function() {
        return inertia("Main");
    });

});

// POST method
Route::post('/login', [LoginController::class, "login"])->name("login");
