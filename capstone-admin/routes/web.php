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

Route::get('/', [LoginController::class, "index"]);

// login
Route::get('/dashboard', [LoginController::class, "dashboard"]);
Route::post('/login', [LoginController::class, "login"]);

// government
Route::get("/news", [NewsController::class, "index"]);
Route::get("/advisory", [AdvisoryController::class, "index"]);
Route::get("/executives", [ExecutivesController::class, "index"]);
Route::get("/hotlines", [HotlinesController::class, "index"]);
Route::get("/job-postings", [JobPostingController::class, "index"]);
Route::get("/population", [PopulationController::class, "index"]);
