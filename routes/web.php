<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
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
//home
Route::get("/", [HomeController::class, "index"]);
//contact
Route::get("/contact", [ContactController::class, "index"])->name("contact");
Route::post("/contact/send", [ContactController::class, "sendMessage"])->name("send");
//shop
Route::get("/shop", [ShopController::class, "index"])->name("shop");
//about
Route::get("/about", function (){
    return view("about");
})->name("about");

/***********User Routes End**********/

/***********Admin Routes**********/
Route::get("/admin", function (){
    return view("admin.admin_dash");
});
/***********Admin Routes End**********/



