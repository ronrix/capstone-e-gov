<?php

use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Business\BusinessesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Government\NewsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Government\HotlinesController;
use App\Http\Controllers\Government\ExecutivesController;
use App\Http\Controllers\Government\JobPostingController;
use App\Http\Controllers\Government\PopulationController;
use App\Http\Controllers\Government\ProgramsEventsController;
use App\Http\Controllers\Business\PermitController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\RequestNotificationController;
use App\Http\Controllers\Services\ServicesController;
use App\Http\Controllers\Tourism\FestivalsController;
use App\Http\Controllers\Tourism\TourismController;
use Illuminate\Http\Request;

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

// get requests
Route::get("/news", [NewsController::class, "getNews"])->middleware("cors");
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

// government
Route::middleware(["auth"])->group(function () {
    Route::get('/dashboard', [LoginController::class, "dashboard"]);

    # notifications
    Route::get("/notifications", [RequestNotificationController::class, 'getNotifications']); # get all the notifications
    Route::get("/notify-status/{id}", [RequestNotificationController::class, 'notifyStatus']);
    Route::get("/post-request/decline/{id}", [RequestNotificationController::class, 'declineRequest']);
    Route::get("/post-request/accept/{id}", [RequestNotificationController::class, 'acceptRequest']);

    // change password
    Route::post('/change-password', [LoginController::class, "changePassword"]);

    // routes to get deleted data
    Route::get('/news/deleted', [NewsController::class, 'getAllTrashed']);
    Route::get('/programs-and-events/deleted', [ProgramsEventsController::class, 'getAllTrashed']);
    Route::get('/tourist-attractions/deleted', [TourismController::class, 'getAllTrashed']);
    Route::get('/festivals/deleted', [FestivalsController::class, 'getAllTrashed']);
    Route::get('/business-establishment/deleted', [BusinessesController::class, 'getAllTrashed']);
    Route::get('/apartments/deleted', [BusinessesController::class, 'getAllTrashedApartments']);

    // routes to restore dat
    Route::post('/news/restore', [NewsController::class, 'restore']);
    Route::post('/programs-and-events/restore', [ProgramsEventsController::class, 'restore']);
    Route::post('/tourist-attractions/restore', [TourismController::class, 'restore']);
    Route::post('/festivals/restore', [FestivalsController::class, 'restore']);
    Route::post('/business-establishment/restore', [BusinessesController::class, 'restore']);
    Route::post('/apartment/restore', [BusinessesController::class, 'restoreApartment']);

    // government post requests
    // edit requests
    Route::post("/news/edit/", [NewsController::class, "editNews"]);
    Route::post("/programs-and-events/edit", [ProgramsEventsController::class, "update"]);
    Route::post("/job-posting/edit", [JobPostingController::class, "update"]);
    Route::post("/hotlines/edit", [HotlinesController::class, "update"]);
    Route::post("/populations/edit", [PopulationController::class, "update"]);
    Route::post("/tourist-attraction/edit", [TourismController::class, "update"]);
    Route::post("/festival/edit", [FestivalsController::class, "update"]);
    Route::post("/businesses/edit", [BusinessesController::class, "update"]);
    Route::post("/apartment/edit", [BusinessesController::class, "updateApartment"]);
    Route::post("/permit/edit", [PermitController::class, "update"]);
    Route::post("/permit/title/edit", [PermitController::class, "updatePermitTitle"]);

    /* services */
    Route::post("/services/requirement/edit", [ServicesController::class, "updateRequirement"]);
    Route::post("/services/process/edit", [ServicesController::class, "updateProcess"]);
    Route::post("/services/intended-for/edit", [ServicesController::class, "updateIntendedFor"]);

    /* official seal */
    Route::post("/official-seal/edit", [AboutController::class, "updateOfficialSeal"]);
    Route::post("/official-seal/symbol-img/save", [AboutController::class, "saveSymbolImg"]);

    /* contacts */
    Route::post("/contacts/edit", [AboutController::class, "updateContacts"]);
    /* add new section for the permit (BPLO) */
    Route::post("/permit/add/section", [PermitController::class, "addNewSection"]);

    // create requests
    Route::post("/hotlines/create", [HotlinesController::class, "create"]);
    Route::post("/news/create/", [NewsController::class, "create"]);
    Route::post("/programs-and-events/add", [ProgramsEventsController::class, "create"]);
    Route::post("/current-official/add", [ExecutivesController::class, "createCurrentOfficial"]);
    Route::post("/former-official/add", [ExecutivesController::class, "createFormerOfficial"]);
    Route::post("/barangay-official/add", [ExecutivesController::class, "createBarangayOfficial"]);
    Route::post("/department-head/add", [ExecutivesController::class, "createDepHead"]);
    Route::post("/job-posting/add", [JobPostingController::class, "create"]);
    Route::post("/population/add", [PopulationController::class, "create"]);
    Route::post("/tourist-attraction/add", [TourismController::class, "create"]);
    Route::post("/festival/add", [FestivalsController::class, "create"]);
    Route::post("/businesses/add", [BusinessesController::class, "create"]);
    Route::post("/apartment/add", [BusinessesController::class, "createApartment"]);
    Route::post("/permit/add", [PermitController::class, "create"]);
    Route::post("/permit/add/requirement", [PermitController::class, "saveNewRequirement"]);
    /* scholarship */
    Route::post("/services/{service}/requirement/add", [ServicesController::class, "createRequirement"]);
    Route::post("/services/{service}/process/add", [ServicesController::class, "createProcess"]);
    /* official seal */
    Route::post("/official-seal/add", [AboutController::class, "createOfficialSeal"]);
    /* contacts */
    Route::post("/contacts/add", [AboutController::class, "createContact"]);
    Route::post("/contacts/list/add", [AboutController::class, "addNewNumber"]);
    Route::post("/socmed/add", [AboutController::class, "createNewSocialLink"]);

    // delete requests
    Route::post("/hotlines/delete", [HotlinesController::class, "delete"]);
    Route::post("/delete-news", [NewsController::class, "deleteOneNews"]);
    Route::post("/delete-current-official/", [ExecutivesController::class, "deleteOneFromCurrent"]);
    Route::post("/delete-former-official/", [ExecutivesController::class, "deleteOneFromFormer"]);
    Route::post("/delete-barangay-official/", [ExecutivesController::class, "deleteOneBarangay"]);
    Route::post("/delete-deparment-head/", [ExecutivesController::class, "deleteOneDepHead"]);
    Route::post("/delete-programs-events", [ProgramsEventsController::class, "deleteOne"]);
    Route::post("/delete-job-posting", [JobPostingController::class, "deleteOne"]);
    Route::post("/delete-population", [PopulationController::class, "deleteOne"]);
    Route::post("/delete-tourist-spot", [TourismController::class, "delete"]);
    Route::post("/delete-festival", [FestivalsController::class, "delete"]);
    Route::post("/delete-businesses", [BusinessesController::class, "delete"]);
    Route::post("/delete-apartment", [BusinessesController::class, "deleteApartment"]);
    Route::post("/delete-whole-permit", [PermitController::class, "deletePermit"]);
    Route::post("/delete-section-permit", [PermitController::class, "deleteSectionPermit"]);
    Route::post("/delete-permit-req", [PermitController::class, "deleteOneReq"]);

    /* services */
    Route::post("/services/{service}/requirement/delete", [ServicesController::class, "deleteRequirement"]);
    Route::post("/services/{service}/process/delete", [ServicesController::class, "deleteProcess"]);

    /* official seal */
    Route::post("/official-seal/delete", [AboutController::class, "deleteOfficialSeal"]);
    /* contacts */
    Route::post("/contact/delete", [AboutController::class, "deleteContact"]);

    //  upload a file
    Route::post("/upload-file", [FilesController::class, "saveFile"]);
    Route::post("/file/delete", [FilesController::class, "delete"]);

    // government
    Route::get("/government/{any}", function () {
        return inertia("Main");
    })->where("any", ".*");
    // tourism
    Route::get("/tourism/{any}", function () {
        return inertia("Main");
    })->where("any", ".*");

    // businesses
    Route::get("/businesses/{any}", function () {
        return inertia("Main");
    })->where("any", ".*");

    // services
    /* services - get the service type for navs*/
    Route::get("/service-types", [ServicesController::class, "getAllServiceTypes"]);
    Route::post("/service/create", [ServicesController::class, "createNewService"]);
    Route::get("/services/{any}", function () {
        return inertia("Main");
    })->where("any", ".*");

    // about
    Route::get("/about/{any}", function () {
        return inertia("Main");
    })->where("any", ".*");
});

// POST method
Route::post('/login', [LoginController::class, "login"])->name("login");
