<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){

    }
    public function addToCart(ProductModel $product, Request $request){
        $cart = Session::get("products");

        $cart[$product->id] = $request->amount;

        Session::put("products", $cart);


        return response([
            "success"=>Session::get("products")
        ]);
    }
}
