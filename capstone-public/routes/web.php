<?php

use Illuminate\Support\Facades\Route;
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
require base_path('routes/admin.php');

Route::get('/', function () {
    return view('welcome');
});

// using response to instead of plain text
// with response it will defaultly send status code as 200. 
// you can add headers and custom headers to your response
Route::get("/hello", function () {
    return response("Hello, World", 200)
    ->header("Content-Type", "text/plain")
    ->header("Custom-Header", "value");
});

// you can also pass a parameter
// and filterized the value of parameter.
// it will return 404 not found if the paramater doesn't meet the where() clause
Route::get("/test/{id}", function ($id) {
    return response("Post ". $id);
})->where("id", "[0-9]+");

// using Request to get the query parameters
Route::get('/search', function (Request $request) {
    dd($request);
    $firstname = $request->query("firstname");
    $lastname = $request->query("lastname");
   return response($firstname . " " . $lastname);
});

// API Response
// using json response and associative array
Route::get('/api', function () {
   return response()->json([
    "post" => [
            "title" => "Post one",
            "desc" => "this is the description",
    ],
    "user" => [
        "name" => "ronrix",
        "age" => "22"
    ] 
   ]);
});

// passing data to view
Route::get('show-products', function () {
    return view("test", [
        "product_info" => [
            [
            "name" => "product",
            "stocks" => 20
        ]
    ],
        "seller_info" => [
            [
            "name" => "seller",
            "age" => 20,
        ]
    ],
    ]);
});