<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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
        Route::get("/shop/search", "search")->name("shop.search");
        Route::get("/product/{product}","permalink")->name("product.permalink");
    });
//about
Route::get("/about", function (){
    return view("about");
})->name("about");
//shopping cart
Route::controller(CartController::class)
    ->prefix("/cart")
    ->group(function (){
        Route::get("", "index")->name("cart.view");
        Route::post("/add/{product}", "addToCart");
    });
//orders
Route::controller(OrderController::class)
    ->name("order.")
    ->prefix("/order")
    ->group(function (){
        Route::get("/user","userOrders")->name("user");
        Route::post("/send", "sendOrder")->name("send");
    });


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
            Route::get("/edit/more/{product}", "pushToEditProduct")->name("edit.more");
            Route::get("/add","pushToAdd")->name("add");

            Route::post("/edit/{product}","editProduct")->name("edit");
            Route::post("/edit/size/{size}", "editProductSize")->name("edit.size");
            Route::post("/add/size/{product}","addProductSize")->name("add.size");
            Route::post("/delete/{product}","deleteProduct")->name("delete");
        });

});
/***********Admin Routes End**********/


Auth::routes();

