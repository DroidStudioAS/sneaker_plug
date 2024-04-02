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
    public function editProduct(ProductModel $product, Request $request){
        $request->validate([
            "Name"=>"required|string",
            "available_amount"=>"required|int|gte:0",
            "category_id"=>"required|int|gte:0",
            "description"=>"required|string",
            "price"=>"required|int|gte:0"
        ]);

        $product->update($request->except("_token"));

        return response([
            "success"=>true
        ]);

    }
    public function deleteProduct(ProductModel $product, Request $request){
        $product->delete();

        return response([
            "success"=>true
        ]);
    }
    public function addProduct(Request $request){
        $request->validate([
            "Name"=>"required|string",
            "available_amount"=>"required|int|gte:0",
            "category_id"=>"required|int|gte:0",
            "description"=>"required|string",
            "price"=>"required|int|gte:0",
            "image_name"=>"required|string"
        ]);

        ProductModel::create($request->except("_token"));

        return redirect()->back();
    }
}
