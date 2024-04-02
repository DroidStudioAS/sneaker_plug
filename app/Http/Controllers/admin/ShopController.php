<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $productRepo;

    public function __construct(){
        $this->productRepo = new ProductRepository();
    }
    public function index(){
        $products = $this->productRepo->getAllProducts();
        $categories = CategoryModel::all();

        return view("admin.admin_products", compact("products","categories"));
    }
    public function editProduct(ProductModel $product, ProductRequest $request){
        $this->productRepo->editProduct($product,$request);

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
    public function addProduct(ProductRequest $request){

        $this->productRepo->createNewProduct($request);

        return redirect()->back()->with("message","$request->Name Created successfully");
    }
}
