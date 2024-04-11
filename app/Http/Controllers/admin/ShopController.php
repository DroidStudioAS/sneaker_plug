<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\AvailableSizes;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $productRepo;
    private $categoryRepo;

    public function __construct(){
        $this->productRepo = new ProductRepository();
        $this->categoryRepo= new CategoryRepository();
    }

    public function index(){
        $products = ProductModel::all();
        $categories = CategoryModel::all();

        return view("admin.admin_products", compact("products","categories"));
    }

    //request is sent only for the csrf token;
    public function deleteProduct(ProductModel $product, Request $request){
        $this->productRepo->deleteProduct($product);

        return response([
            "success"=>true
        ]);
    }
    public function addProduct(ProductRequest $request){

        $this->productRepo->createNewProduct($request);

        return redirect()->back()->with("message","$request->Name Created successfully");
    }
    public function pushToEditProduct(ProductModel $product)
    {
        $categories = CategoryModel::all();
        return view("admin.edit_product", compact("product","categories"));
    }

    public function editProductSize(AvailableSizes $size, Request $request){
        $size->available=$request->available;
        $size->save();

        return response([
            "success"=>true
        ]);
    }
    public function addProductSize(Request $request){
        dd($request->all());
    }
    public function editProduct($product,Request $request){
        dd($request->all());
    }
}
