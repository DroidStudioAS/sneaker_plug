<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        $products = ProductModel::all();


        return view("shop", compact("products"));
    }

}
