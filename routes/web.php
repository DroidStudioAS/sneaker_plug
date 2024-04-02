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
//contact
Route::controller(ContactController::class)->group(function(){
    Route::get("/contact", "index")->name("contact");
    Route::post("/contact/send", "sendMessage")->name("send");
});
//home
Route::get("/", [HomeController::class, "index"])->name("home");
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
        //contanct
        Route::controller(\App\Http\Controllers\admin\ContactController::class)->group(function (){
            Route::get("/","index")->name("admin_panel");
            Route::post("/edit-message/{contact}","editMessage");
            Route::post("/delete-message/{contact}", "deleteMessage");
        });

        //shop
        Route::controller(\App\Http\Controllers\admin\ShopController::class)->group(function(){
            Route::get("/shop", "index")->name("admin_shop");
            Route::post("/add-product","addProduct")->name("add_product");
            Route::post("/edit-product/{product}","editProduct")->name("edit_product");
            Route::post("/delete-product/{product}","deleteProduct")->name("delete_product");
        });

});
/***********Admin Routes End**********/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
