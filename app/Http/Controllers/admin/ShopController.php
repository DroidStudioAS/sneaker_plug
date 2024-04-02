<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        $products = ProductModel::all();
        $categories = CategoryModel::all();

        return view("admin.admin_products", compact("products","categories"));
    }
}
