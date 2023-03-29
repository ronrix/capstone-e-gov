<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Government\NewsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Government\AdvisoryController;
use App\Http\Controllers\Government\HotlinesController;
use App\Http\Controllers\Government\ExecutivesController;
use App\Http\Controllers\Government\JobPostingController;
use App\Http\Controllers\Government\PopulationController;
use App\Http\Controllers\Government\ProgramsEventsController;
use App\Models\Government\JobPosting;

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

// public get methods
// get news json response data
Route::get("/news", [NewsController::class, "getNews"]);

// government
Route::middleware(["auth"])->group(function () {
    Route::get('/dashboard', [LoginController::class, "dashboard"]);
    // government
    Route::get("/government/news", [NewsController::class, "index"]);
    Route::get("/government/programs-and-events", function() {
        return inertia("Main");
    });
    Route::get("/government/executives/current-officials", function() {
        return inertia("Main");
    });
    Route::get("/government/executives/former-officials", function() {
        return inertia("Main");
    });
    Route::get("/government/executives/barangay-officials", function() {
        return inertia("Main");
    });
    Route::get("/government/executives/department-heads", function() {
        return inertia("Main");
    });
    Route::get("/government/job-postings", function() {
        return inertia("Main");
    });
    Route::get("/government/full-disclosure-reports", function() {
        return inertia("Main");
    });
    Route::get("/government/hotlines", function() {
        return inertia("Main");
    });
    Route::get("/government/demographic-profile", function() {
        return inertia("Main");
    });

    // government get requests
    Route::get("/programs-and-events/", [ProgramsEventsController::class, "index"]);
    Route::get("/current-officials", [ExecutivesController::class, "index"]);
    Route::get("/former-officials", [ExecutivesController::class, "getFormerOfficials"]);
    Route::get("/barangay-officials", [ExecutivesController::class, "getBarangayOfficials"]);
    Route::get("/department-heads", [ExecutivesController::class, "getDepartmentHeads"]);
    Route::get("/job-postings", [JobPostingController::class, "index"]);

    // government post requests
    Route::post("/delete-news/{id}", [NewsController::class, "deleteOneNews"]);
    Route::post("/news/edit/", [NewsController::class, "editNews"]);
    Route::post("/news/create/", [NewsController::class, "create"]);
    Route::post("/delete-programs-events", [ProgramsEventsController::class, "deleteOne"]);
    Route::post("/programs-and-events/edit", [ProgramsEventsController::class, "update"]);
    Route::post("/programs-and-events/add", [ProgramsEventsController::class, "create"]);

    Route::post("/current-official/add", [ExecutivesController::class, "createCurrentOfficial"]);
    Route::post("/former-official/add", [ExecutivesController::class, "createFormerOfficial"]);
    Route::post("/barangay-official/add", [ExecutivesController::class, "createBarangayOfficial"]);
    Route::post("/department-head/add", [ExecutivesController::class, "createDepHead"]);

    Route::post("/delete-current-official/", [ExecutivesController::class, "deleteOneFromCurrent"]);
    Route::post("/delete-former-official/", [ExecutivesController::class, "deleteOneFromFormer"]);
    Route::post("/delete-barangay-official/", [ExecutivesController::class, "deleteOneBarangay"]);
    Route::post("/delete-deparment-head/", [ExecutivesController::class, "deleteOneDepHead"]);

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
    Route::get("/businesses/BPLO", function() {
        return inertia("Main");
    });
    Route::get("/businesses/ease-of-doing-business", function() {
        return inertia("Main");
    });
    Route::get("/businesses/business-establishments", function() {
        return inertia("Main");
    });

    // services
    Route::get("/services/office-of-the-mayor/scholarship-program", function() {
        return inertia("Main");
    });
    Route::get("/services/office-of-the-mayor/civil-wedding-schedule", function() {
        return inertia("Main");
    });
    Route::get("/services/office-of-the-mayor/mayors-clearance", function() {
        return inertia("Main");
    });
    Route::get("/services/mswd-department/government-id", function() {
        return inertia("Main");
    });
    Route::get("/services/mswd-department/replacement-of-senior-citizen", function() {
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
