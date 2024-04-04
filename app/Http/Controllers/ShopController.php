<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Repositories\ProductRepository;
use App\Repositories\SizeRepository;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $productRepo;
    private $sizeRepo;
    public function __construct(){
        $this->productRepo = new ProductRepository();
        $this->sizeRepo = new SizeRepository();
    }
    public function index(){
        $products = ProductModel::all();
        $categories = CategoryModel::all();
        return view("shop", compact("products", "categories"));
    }
    public function permalink($product){
        $singleProduct = $this->productRepo->getSingleProduct($product);
        $totalAvailable = $this->sizeRepo->getSizesForProduct($product);

        return view("product", compact("singleProduct", "totalAvailable"));
    }
    public function search(Request $request){
        $products= ProductModel::where("Name", "LIKE", "%$request->Name%")
            ->where(["category_id"=>$request->category_id])
            ->where("price", "<=" ,$request->price)
            ->get();
        dd($products);

    }

}
