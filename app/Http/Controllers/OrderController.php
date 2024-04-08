<?php

namespace App\Http\Controllers;

use App\Models\OrderItemsModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    private $productRepo;
    public function __construct(){
        $this->productRepo=new ProductRepository();
    }
    public function index($product)
    {
        return view("order");
    }
    public function sendOrder(Request $request)
    {
        $cart = Session::get("products");
        $totalPrice = 0;

        foreach ($cart as $product){
            $dbProduct = $this->productRepo->getSingleProduct($product["product_id"]);
            $totalPrice+=$dbProduct->price;
        }
        $newOrder = OrderModel::create([
            "contact_email"=>$request->contact_email,
            "contact_number"=>$request->contact_number,
            "payment_method"=>$request->payment_method,
            "total_price"=>$totalPrice
        ]);

        foreach ($cart as $product){
            $dbProduct = $this->productRepo->getSingleProduct($product["product_id"]);
            OrderItemsModel::create([
                "order_id"=>$newOrder->id,
                "product_id"=>$product["product_id"],
                "size"=>$product["size"],
                "amount"=>$product["amount"],
                "price"=>$dbProduct->price
            ]);
        }

        dd("order written");
    }
}
