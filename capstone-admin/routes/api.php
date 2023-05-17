<?php

use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Business\BusinessesController;
use App\Http\Controllers\Business\PermitController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\Government\ExecutivesController;
use App\Http\Controllers\Government\HotlinesController;
use App\Http\Controllers\Government\JobPostingController;
use App\Http\Controllers\Government\NewsController;
use App\Http\Controllers\Government\OrdinancesController;
use App\Http\Controllers\Government\PopulationController;
use App\Http\Controllers\Government\ProgramsEventsController;
use App\Http\Controllers\RequestNotificationController;
use App\Http\Controllers\SearchQueryController;
use App\Http\Controllers\Services\ServicesController;
use App\Http\Controllers\Tourism\FestivalsController;
use App\Http\Controllers\Tourism\TourismController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// set an api token for SPA
Route::get('/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
})->middleware("cors");

// get the time
// Your protected routes go here
Route::get("/server-time", function () {
    $now = new DateTime('now', new DateTimeZone('Asia/Manila'));
    return response()->json(["time" => $now]);
})->middleware("cors");

// public get methods
// get news json response data
Route::get("/news", [NewsController::class, "getNews"]);
Route::get("/programs-and-events/", [ProgramsEventsController::class, "index"]);
Route::get("/current-officials", [ExecutivesController::class, "index"])->middleware("cors");
Route::get("/former-officials", [ExecutivesController::class, "getFormerOfficials"])->middleware("cors");
Route::get("/barangay-officials", [ExecutivesController::class, "getBarangayOfficials"])->middleware("cors");
Route::get("/department-heads", [ExecutivesController::class, "getDepartmentHeads"])->middleware("cors");
Route::get("/job-postings", [JobPostingController::class, "index"])->middleware("cors");
Route::get("/hotlines", [HotlinesController::class, "index"])->middleware("cors");
Route::get("/populations", [PopulationController::class, "index"])->middleware("cors");
Route::get("/tourist-attractions", [TourismController::class, "index"])->middleware("cors");
Route::get("/festivals", [FestivalsController::class, "index"])->middleware("cors");
Route::get("/businesses", [BusinessesController::class, "index"])->middleware("cors");
Route::get("/apartments", [BusinessesController::class, "getAllApartments"])->middleware("cors");
Route::get("/permits", [PermitController::class, "index"])->middleware("cors");
Route::get("/services/{service}", [ServicesController::class, "get"])->middleware("cors");
Route::get("/official-seal", [AboutController::class, "getOfficialSeal"])->middleware("cors");
Route::get("/contacts", [AboutController::class, "getContacts"])->middleware("cors");
// GET Files
Route::get("/full-disclosure-reports", [FilesController::class, "getDisclosureReports"])->middleware("cors");
Route::get("/application-forms", [FilesController::class, "getApplicationForms"])->middleware("cors");
Route::get("/file/download/{file}", [FilesController::class, "download"])->middleware("cors");
Route::get("/service-types", [ServicesController::class, "getAllServiceTypes"])->middleware("cors");
Route::get("/faq", [AboutController::class, "getFAQs"])->middleware("cors");
Route::get("/ordinances", [OrdinancesController::class, "getOrdinances"])->middleware("cors");

// Broadcasting events
Route::post("/event", [RequestNotificationController::class, 'eventHandler'])->middleware("cors");

// search query
Route::post("/search", [SearchQueryController::class, 'search'])->middleware("cors");
