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
        return view("shop", compact("products"));
    }
    public function permalink($product){
        $singleProduct = $this->productRepo->getSingleProduct($product);
        $totalAvailable = $this->sizeRepo->getSizesForProduct($product);

        return view("product", compact("singleProduct", "totalAvailable"));
    }

}
