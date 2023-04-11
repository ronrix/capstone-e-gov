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
use App\Http\Controllers\Services\Agriculture\CapacityBuildingEnhancementTraining;
use App\Http\Controllers\Services\Agriculture\DeliveryOfFarmsFisheryInputs;
use App\Http\Controllers\Services\Agriculture\DistributionsOfAssortedSeedings;
use App\Http\Controllers\Services\Agriculture\IssuanceOfMOACertification;
use App\Http\Controllers\Services\Agriculture\TechnicalAssistanceForFarmers;
use App\Http\Controllers\Services\Agriculture\TreatmentVacinnationOfAnimals;
use App\Http\Controllers\Services\CivilWeddingController;
use App\Http\Controllers\Services\MayorClearanceController;
use App\Http\Controllers\Services\MSWDController;
use App\Http\Controllers\Services\PublicEmploymentController;
use App\Http\Controllers\Services\ServicesController;
use App\Http\Controllers\Tourism\FestivalsController;
use App\Http\Controllers\Tourism\TourismController;

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
    Route::get("/government/programs-and-events", function () {
        return inertia("Main");
    });
    Route::get("/government/executives/current-officials", function () {
        return inertia("Main");
    });
    Route::get("/government/executives/former-officials", function () {
        return inertia("Main");
    });
    Route::get("/government/executives/barangay-officials", function () {
        return inertia("Main");
    });
    Route::get("/government/executives/department-heads", function () {
        return inertia("Main");
    });
    Route::get("/government/job-postings", function () {
        return inertia("Main");
    });
    Route::get("/government/full-disclosure-reports", function () {
        return inertia("Main");
    });
    Route::get("/government/hotlines", function () {
        return inertia("Main");
    });
    Route::get("/government/demographic-profile", function () {
        return inertia("Main");
    });

    // government get requests
    Route::get("/programs-and-events/", [ProgramsEventsController::class, "index"]);
    Route::get("/current-officials", [ExecutivesController::class, "index"]);
    Route::get("/former-officials", [ExecutivesController::class, "getFormerOfficials"]);
    Route::get("/barangay-officials", [ExecutivesController::class, "getBarangayOfficials"]);
    Route::get("/department-heads", [ExecutivesController::class, "getDepartmentHeads"]);
    Route::get("/job-postings", [JobPostingController::class, "index"]);
    Route::get("/hotlines", [HotlinesController::class, "index"]);
    Route::get("/populations", [PopulationController::class, "index"]);
    Route::get("/tourist-attractions", [TourismController::class, "index"]);
    Route::get("/festivals", [FestivalsController::class, "index"]);
    Route::get("/businesses", [BusinessesController::class, "index"]);
    Route::get("/apartments", [BusinessesController::class, "getAllApartments"]);
    Route::get("/permits", [PermitController::class, "index"]);
    Route::get("/scholarship", [ServicesController::class, "getScholarshipProgram"]);
    Route::get("/mayor-clearance", [MayorClearanceController::class, "getMayorClearance"]);
    Route::get("/civil-wedding", [CivilWeddingController::class, "getCivilWedding"]);
    Route::get("/government-id", [MSWDController::class, "getGovernmentId"]);
    Route::get("/replacement-senior-citizen", [MSWDController::class, "getSeniorCitizen"]);
    Route::get("/job-fair", [PublicEmploymentController::class, "getJobFair"]);
    Route::get("/spes", [PublicEmploymentController::class, "getSpes"]);
    Route::get("/technical-assistance-for-farmers", [TechnicalAssistanceForFarmers::class, "index"]);
    Route::get("/treatment-vaccination-of-animals", [TreatmentVacinnationOfAnimals::class, "index"]);
    Route::get("/distributions-assorted-seeds", [DistributionsOfAssortedSeedings::class, "index"]);
    Route::get("/delivery-farm-fishery-inputs", [DeliveryOfFarmsFisheryInputs::class, "index"]);
    Route::get("/issuance-moa-certification", [IssuanceOfMOACertification::class, "index"]);
    Route::get("/capacity-building-enhancement-training", [CapacityBuildingEnhancementTraining::class, "index"]);
    Route::get("/official-seal", [AboutController::class, "getOfficialSeal"]);
    Route::get("/contacts", [AboutController::class, "getContacts"]);

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
    /* scholarship */
    Route::post("/scholarship/requirement/edit", [ServicesController::class, "updateRequirement"]);
    Route::post("/scholarship/process/edit", [ServicesController::class, "updateProcess"]);
    /* mayor's  clearance */
    Route::post("/mayor-clearance/requirement/edit", [MayorClearanceController::class, "updateRequirement"]);
    Route::post("/mayor-clearance/process/edit", [MayorClearanceController::class, "updateProcess"]);
    /* civil  wedding */
    Route::post("/civil-wedding/requirement/edit", [CivilWeddingController::class, "updateRequirement"]);
    Route::post("/civil-wedding/process/edit", [CivilWeddingController::class, "updateProcess"]);
    /* mswd  government id */
    Route::post("/government-id/requirement/edit", [MSWDController::class, "updateRequirement"]);
    Route::post("/government-id/process/edit", [MSWDController::class, "updateProcess"]);
    /* mswd  replacement of senior citizen */
    Route::post("/replacement-senior-citizen/requirement/edit", [MSWDController::class, "updateRequirementSenior"]);
    Route::post("/replacement-senior-citizen/process/edit", [MSWDController::class, "updateProcessSenior"]);
    /* public employment service office - job fair */
    Route::post("/job-fair/requirement/edit", [PublicEmploymentController::class, "updateRequirement"]);
    Route::post("/job-fair/process/edit", [PublicEmploymentController::class, "updateProcess"]);
    /* public employment service office - spes */
    Route::post("/spes/requirement/edit", [PublicEmploymentController::class, "updateRequirementSPES"]);
    Route::post("/spes/process/edit", [PublicEmploymentController::class, "updateProcessSPES"]);
    /* agriculture - technical assistance for farmers */
    Route::post("/technical-assistance-for-farmers/requirement/edit", [TechnicalAssistanceForFarmers::class, "updateRequirement"]);
    Route::post("/technical-assistance-for-farmers/process/edit", [TechnicalAssistanceForFarmers::class, "updateProcess"]);
    /* agriculture - treatment vaccination of animals*/
    Route::post("/treatment-vaccination-of-animals/requirement/edit", [TreatmentVacinnationOfAnimals::class, "updateRequirement"]);
    Route::post("/treatment-vaccination-of-animals/process/edit", [TreatmentVacinnationOfAnimals::class, "updateProcess"]);
    /* agriculture - distributions of assorted seeds */
    Route::post("/distributions-assorted-seeds/requirement/edit", [DistributionsOfAssortedSeedings::class, "updateRequirement"]);
    Route::post("/distributions-assorted-seed/process/edit", [DistributionsOfAssortedSeedings::class, "updateProcess"]);
    /* agriculture - delivery of farm and fishery inputs */
    Route::post("/delivery-farm-fishery-inputs/requirement/edit", [DeliveryOfFarmsFisheryInputs::class, "updateRequirement"]);
    Route::post("/delivery-farm-fishery-inputs/process/edit", [DeliveryOfFarmsFisheryInputs::class, "updateProcess"]);
    /* agriculture - issuance of moa certification */
    Route::post("/issuance-moa-certification/requirement/edit", [IssuanceOfMOACertification::class, "updateRequirement"]);
    Route::post("/issuance-moa-certification/process/edit", [IssuanceOfMOACertification::class, "updateProcess"]);
    /* agriculture - capacity building enhancement training */
    Route::post("/capacity-building-enhancement-training/requirement/edit", [CapacityBuildingEnhancementTraining::class, "updateRequirement"]);
    Route::post("/capacity-building-enhancement-training/process/edit", [CapacityBuildingEnhancementTraining::class, "updateProcess"]);
    /* official seal */
    Route::post("/official-seal/edit", [AboutController::class, "updateOfficialSeal"]);
    Route::post("/official-seal/symbol-img/save", [AboutController::class, "saveSymbolImg"]);
    /* contacts */
    Route::post("/contacts/edit", [AboutController::class, "updateContacts"]);

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
    Route::post("/scholarship/requirement/add", [ServicesController::class, "createRequirement"]);
    Route::post("/scholarship/process/add", [ServicesController::class, "createProcess"]);
    /* mayor's clearance */
    Route::post("/mayor-clearance/requirement/add", [MayorClearanceController::class, "createRequirement"]);
    Route::post("/mayor-clearance/process/add", [MayorClearanceController::class, "createProcess"]);
    /* civil wedding */
    Route::post("/civil-wedding/requirement/add", [CivilWeddingController::class, "createRequirement"]);
    Route::post("/civil-wedding/process/add", [CivilWeddingController::class, "createProcess"]);
    /* mswd government id */
    Route::post("/government-id/requirement/add", [MSWDController::class, "createRequirement"]);
    Route::post("/government-id/process/add", [MSWDController::class, "createProcess"]);
    /* mswd replacement of senior citizen */
    Route::post("/replacement-senior-citizen/requirement/add", [MSWDController::class, "createRequirementSenior"]);
    Route::post("/replacement-senior-citizen/process/add", [MSWDController::class, "createProcessSenior"]);
    /* public employment service office - job fair */
    Route::post("/job-fair/requirement/add", [PublicEmploymentController::class, "createRequirement"]);
    Route::post("/job-fair/process/add", [PublicEmploymentController::class, "createProcess"]);
    /* public employment service office - spes */
    Route::post("/spes/requirement/add", [PublicEmploymentController::class, "createRequirementSPES"]);
    Route::post("/spes/process/add", [PublicEmploymentController::class, "createProcessSPES"]);
    /* agriculture - treatment assistance for farmers */
    Route::post("/technical-assistance-for-farmers/requirement/add", [TechnicalAssistanceForFarmers::class, "createRequirement"]);
    Route::post("/technical-assistance-for-farmers/process/add", [TechnicalAssistanceForFarmers::class, "createProcess"]);
    /* agriculture - treatment vaccination of animals*/
    Route::post("/treatment-vaccination-of-animals/requirement/add", [TreatmentVacinnationOfAnimals::class, "createRequirement"]);
    Route::post("/treatment-vaccination-of-animals/process/add", [TreatmentVacinnationOfAnimals::class, "createProcess"]);
    /* agriculture - distribution of assorted seeds */
    Route::post("/distributions-assorted-seeds/requirement/add", [DistributionsOfAssortedSeedings::class, "createRequirement"]);
    Route::post("/distributions-assorted-seeds/process/add", [DistributionsOfAssortedSeedings::class, "createProcess"]);
    /* agriculture - delivery farm and fishery inputs */
    Route::post("/delivery-farm-fishery-inputs/requirement/add", [DeliveryOfFarmsFisheryInputs::class, "createRequirement"]);
    Route::post("/delivery-farm-fishery-inputs/process/add", [DeliveryOfFarmsFisheryInputs::class, "createProcess"]);
    /* agriculture - issuance of moa certification */
    Route::post("/issuance-moa-certification/requirement/add", [IssuanceOfMOACertification::class, "createRequirement"]);
    Route::post("/issuance-moa-certification/process/add", [IssuanceOfMOACertification::class, "createProcess"]);
    /* agriculture - capacity of building enhancement training */
    Route::post("/capacity-building-enhancement-training/requirement/add", [CapacityBuildingEnhancementTraining::class, "createRequirement"]);
    Route::post("/capacity-building-enhancement-training/process/add", [CapacityBuildingEnhancementTraining::class, "createProcess"]);
    /* official seal */
    Route::post("/official-seal/add", [AboutController::class, "createOfficialSeal"]);
    /* contacts */
    Route::post("/contacts/add", [AboutController::class, "createContacts"]);

    // delete requests
    Route::post("/delete-news/{id}", [NewsController::class, "deleteOneNews"]);
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
    /* scholarship */
    Route::post("/scholarship/requirement/delete", [ServicesController::class, "deleteRequirement"]);
    Route::post("/scholarship/process/delete", [ServicesController::class, "deleteProcess"]);
    /* mayor's clearance */
    Route::post("/mayor-clearance/requirement/delete", [MayorClearanceController::class, "deleteRequirement"]);
    Route::post("/mayor-clearance/process/delete", [MayorClearanceController::class, "deleteProcess"]);
    /* civil wedding */
    Route::post("/civil-wedding/requirement/delete", [CivilWeddingController::class, "deleteRequirement"]);
    Route::post("/civil-wedding/process/delete", [CivilWeddingController::class, "deleteProcess"]);
    /* mswd government id */
    Route::post("/government-id/requirement/delete", [MSWDController::class, "deleteRequirement"]);
    Route::post("/government-id/process/delete", [MSWDController::class, "deleteProcess"]);
    /* mswd replacement of senior citizen */
    Route::post("/replacement-senior-citizen/requirement/delete", [MSWDController::class, "deleteRequirementSenior"]);
    Route::post("/replacement-senior-citizen/process/delete", [MSWDController::class, "deleteProcessSenior"]);
    /* public employment service office - job fair */
    Route::post("/job-fair/requirement/delete", [PublicEmploymentController::class, "deleteRequirement"]);
    Route::post("/job-fair/process/delete", [PublicEmploymentController::class, "deleteProcess"]);
    /* public employment service office - spes */
    Route::post("/spes/requirement/delete", [PublicEmploymentController::class, "deleteRequirementSPES"]);
    Route::post("/spes/process/delete", [PublicEmploymentController::class, "deleteProcessSPES"]);
    /* agriculture - technical assistance for farmers */
    Route::post("/technical-assistance-for-farmers/requirement/delete", [TechnicalAssistanceForFarmers::class, "deleteRequirement"]);
    Route::post("/technical-assistance-for-farmers/process/delete", [TechnicalAssistanceForFarmers::class, "deleteProcess"]);
    /* agriculture - treatment vaccination of animals */
    Route::post("/treatment-vaccination-of-animals/requirement/delete", [TreatmentVacinnationOfAnimals::class, "deleteRequirement"]);
    Route::post("/treatment-vaccination-of-animals/process/delete", [TreatmentVacinnationOfAnimals::class, "deleteProcess"]);
    /* agriculture - distributions of assorted seeds */
    Route::post("/distributions-assorted-seeds/requirement/delete", [DistributionsOfAssortedSeedings::class, "deleteRequirement"]);
    Route::post("/distributions-assorted-seeds/process/delete", [DistributionsOfAssortedSeedings::class, "deleteProcess"]);
    /* agriculture - delivery of farm and fishery inputs */
    Route::post("/delivery-farm-fishery-inputs/requirement/delete", [DeliveryOfFarmsFisheryInputs::class, "deleteRequirement"]);
    Route::post("/delivery-farm-fishery-inputs/process/delete", [DeliveryOfFarmsFisheryInputs::class, "deleteProcess"]);
    /* agriculture - issuance of moa certification */
    Route::post("/issuance-moa-certification/requirement/delete", [IssuanceOfMOACertification::class, "deleteRequirement"]);
    Route::post("/issuance-moa-certification/process/delete", [IssuanceOfMOACertification::class, "deleteProcess"]);
    /* agriculture - capacity of building enhancement training */
    Route::post("/capacity-building-enhancement-training/requirement/delete", [CapacityBuildingEnhancementTraining::class, "deleteRequirement"]);
    Route::post("/capacity-building-enhancement-training/process/delete", [CapacityBuildingEnhancementTraining::class, "deleteProcess"]);
    /* official seal */
    Route::post("/official-seal/delete", [AboutController::class, "deleteOfficialSeal"]);
    /* contacts */
    Route::post("/contacts/delete", [AboutController::class, "deleteContacts"]);


    // tourism
    Route::get("/tourism/tourism", function () {
        return inertia("Main");
    });
    Route::get("/tourism/tourist-spots", function () {
        return inertia("Main");
    });
    Route::get("/tourism/festivals", function () {
        return inertia("Main");
    });
    Route::get("/tourism/guidelines", function () {
        return inertia("Main");
    });

    // businesses
    Route::get("/businesses/apartments", function () {
        return inertia("Main");
    });
    Route::get("/businesses/BPLO", function () {
        return inertia("Main");
    });
    Route::get("/businesses/ease-of-doing-business", function () {
        return inertia("Main");
    });
    Route::get("/businesses/business-establishments", function () {
        return inertia("Main");
    });

    // services
    Route::get("/services/office-of-the-mayor/scholarship-program", function () {
        return inertia("Main");
    });
    Route::get("/services/office-of-the-mayor/civil-wedding-schedule", function () {
        return inertia("Main");
    });
    Route::get("/services/office-of-the-mayor/mayors-clearance", function () {
        return inertia("Main");
    });
    Route::get("/services/mswd-department/government-id", function () {
        return inertia("Main");
    });
    Route::get("/services/mswd-department/replacement-of-senior-citizen", function () {
        return inertia("Main");
    });
    Route::get("/services/mswd-department/government-id", function () {
        return inertia("Main");
    });
    Route::get("/services/agriculture-department/technical-assistance-for-farmer", function () {
        return inertia("Main");
    });
    Route::get("/services/agriculture-department/treatment-and-vaccination-of-animals", function () {
        return inertia("Main");
    });
    Route::get("/services/agriculture-department/distributions-of-assorted-seeds-seedling", function () {
        return inertia("Main");
    });
    Route::get("/services/agriculture-department/delivery-of-farm-fishery-inputs", function () {
        return inertia("Main");
    });
    Route::get("/services/agriculture-department/issuance-of-moa-certification", function () {
        return inertia("Main");
    });
    Route::get("/services/agriculture-department/capacity-building-enhancement-training", function () {
        return inertia("Main");
    });
    Route::get("/services/public-employment-service-office/special-program-employment-for-students", function () {
        return inertia("Main");
    });
    Route::get("/services/public-employment-service-department/job-fair", function () {
        return inertia("Main");
    });



    // about
    Route::get("/about/mission-and-vision", function () {
        return inertia("Main");
    });
    Route::get("/about/history", function () {
        return inertia("Main");
    });
    Route::get("/about/official-seal", function () {
        return inertia("Main");
    });
    Route::get("/about/contacts", function () {
        return inertia("Main");
    });
});

// POST method
Route::post('/login', [LoginController::class, "login"])->name("login");
