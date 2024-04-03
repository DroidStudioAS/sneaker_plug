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
/***********
 *******User Routes*********
 * All unnamed routes in both
 * user and admin routes
 * are called from JS without
 * the name attribute
 */
//home
Route::get("/", [HomeController::class, "index"])->name("home");
//contact
Route::controller(ContactController::class)
    ->prefix("/contact")
    ->name("contact")
    ->group(function(){
    Route::get("/", "index");
    Route::post("/send", "sendMessage")->name(".send");
});
//shop
Route::controller(ShopController::class)
    ->group(function (){
        Route::get("/shop","index")->name("shop");
        Route::get("/product/{product}","permalink")->name("product.permalink");
    });

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
            ->name("product.")
            ->group(function(){
            Route::get("", "index")->name("admin");
            Route::post("/add","addProduct")->name("add");
            Route::post("/edit/{product}","editProduct")->name("edit");
            Route::post("/delete/{product}","deleteProduct")->name("delete");
        });

});
/***********Admin Routes End**********/


Auth::routes();

