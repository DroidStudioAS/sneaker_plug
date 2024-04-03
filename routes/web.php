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
Route::get("/", [HomeController::class, "index"])->name("home");
//contact
Route::controller(ContactController::class)
    ->prefix("/contact")
    ->group(function(){
    Route::get("/", "index")->name("contact");
    Route::post("/send", "sendMessage")->name("contact.send");
});
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
        Route::controller(\App\Http\Controllers\admin\ContactController::class)
            ->prefix("/contact")
            ->group(function (){
            Route::get("","index")->name("admin.panel");
            Route::post("/edit/{contact}","editMessage");
            Route::post("/delete/{contact}", "deleteMessage");
        });

        //shop /admin/shop
        Route::controller(\App\Http\Controllers\admin\ShopController::class)
            ->prefix("/shop")
            ->group(function(){
            Route::get("", "index")->name("admin.shop");
            Route::post("/add","addProduct")->name("product.add");
            Route::post("/edit/{product}","editProduct")->name("product.edit");
            Route::post("/delete/{product}","deleteProduct")->name("product.delete");
        });

});
/***********Admin Routes End**********/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
