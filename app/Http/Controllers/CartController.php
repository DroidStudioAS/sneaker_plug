<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){

    }
    public function addToCart(ProductModel $product, Request $request){
        return response([
            "success"=>$product
        ]);
    }
}
