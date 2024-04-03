<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Models\ProductModel;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $productRepo;
    public function __construct(){
        $this->productRepo=new ProductRepository();
    }
    public function index(){
        $products= collect([]);

        foreach (Session::get("products") as $id=>$amount){
            $product = $this->productRepo->getSingleProduct($id);
            ProductHelper::addAmountToProduct($product, $amount);
            $products->push($product);
        }
        return view("checkout", compact("products"));
    }
    public function addToCart(ProductModel $product, Request $request){
        $cart = Session::get("products");

        $cart[$product->id] = $request->amount;

        Session::put("products", $cart);


        return response([
            "success"=>Session::get("products")
        ]);
    }
}
