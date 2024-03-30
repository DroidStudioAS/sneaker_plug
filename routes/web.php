<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
/***********User Routes**********/
Route::get("/", [HomeController::class, "index"]);
Route::get("/about", function (){
    return view("about");
})->name("about");
Route::get("/contact", function (){
    return view("contact");
})->name("contact");
Route::get("/shop", function (){
    return view("shop");
})->name("shop");
/***********User Routes End**********/

