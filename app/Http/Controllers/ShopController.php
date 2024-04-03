<?php

namespace App\Http\Controllers;

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
        $products = ProductModel::all();
        return view("shop", compact("products"));
    }
    public function permalink($product){
        $singleProduct = $this->productRepo->getSingleProduct($product);


        return view("product", compact("singleProduct"));
    }

}
