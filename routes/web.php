<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Middleware\AdminMiddleware;
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
Route::middleware(["auth", AdminMiddleware::class])
    ->prefix("/admin")
    ->group(function (){
    Route::get("/",[\App\Http\Controllers\admin\ContactController::class, "index"])->name("admin_panel");
    Route::get("/shop",[\App\Http\Controllers\admin\ShopController::class, "index"])->name("admin_shop");
    Route::post("/edit-message/{contact}",[\App\Http\Controllers\admin\ContactController::class,"editMessage"]);
    Route::post("/delete-message/{contact}",[ \App\Http\Controllers\admin\ContactController::class, "deleteMessage"]);
    Route::post("/add-product",[\App\Http\Controllers\admin\ShopController::class,"addProduct"])->name("add_product");
    Route::post("/edit-product/{product}",[\App\Http\Controllers\admin\ShopController::class,"editProduct"])->name("edit_product");
    Route::post("/delete-product/{product}",[\App\Http\Controllers\admin\ShopController::class,"deleteProduct"])->name("delete_product");
});

/***********Admin Routes End**********/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
