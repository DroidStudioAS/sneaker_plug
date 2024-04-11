<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
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
    public function editProduct(ProductModel $product, ProductRequest $request){
        $this->productRepo->editProduct($product,$request);

        return response([
            "success"=>true
        ]);

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
}
