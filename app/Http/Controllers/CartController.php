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
        $totalPriceOfCart=0;
        if (Session::get("products")===null){
            return view("checkout", compact("products","totalPriceOfCart"));
        }
        foreach (Session::get("products") as $orderArray){
            $product = $this->productRepo->getSingleProduct($orderArray["product_id"]);
           // dd($amountAndSize);
            //amount        //size
            ProductHelper::addAmountAndSizeToProduct($product, $orderArray);
            $products->push($product);

            $totalPriceOfCart+= $product->amount * $product->price;
        }
        return view("checkout", compact("products","totalPriceOfCart"));
    }
    public function addToCart(ProductModel $product, Request $request){
        $cartItem = [
            "product_id"=>$product->id,
            "amount"=>$request->amount,
            "size"=>$request->size
        ];
        Session::push("products", $cartItem);

        //remove duplicate entries
        $products = Session::get("products");
        $products = array_unique($products, SORT_REGULAR);
        Session::put("products", $products);



        return response([
            "success"=>true
        ]);
    }
}
