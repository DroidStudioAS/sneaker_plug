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
        $sum=0;
        foreach (Session::get("products") as $id=>$amountAndSize){
            $product = $this->productRepo->getSingleProduct($id);
            ProductHelper::addAmountAndSizeToProduct($product, $amountAndSize);
            $products->push($product);

            $sum+= $product->amount * $product->price;
        }
        return view("checkout", compact("products","sum"));
    }
    public function addToCart(ProductModel $product, Request $request){
        $cart = Session::get("products");

        $cart[$product->id] = $request->amount ." ". $request->size;

        Session::put("products", $cart);


        return response([
            "success"=>true
        ]);
    }
}
