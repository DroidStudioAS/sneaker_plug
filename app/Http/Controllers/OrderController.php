<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Http\Requests\OrderRequest;
use App\Models\OrderItemsModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    private $productRepo;
    private $orderRepo;
    public function __construct(){
        $this->productRepo=new ProductRepository();
        $this->orderRepo = new OrderRepository();
    }
    public function index($product)
    {
        return view("order");
    }
    public function sendOrder(OrderRequest $request)
    {

        $cart = Session::get("products");
        $products = collect([]);
        $totalPrice = 0;

        foreach ($cart as $product){
            $dbProduct = $this->productRepo->getSingleProduct($product["product_id"]);
            $size = ProductHelper::findSize($dbProduct,floatval($product["size"]));
            $size->available = $size->available-1;
            $size->save();
            $totalPrice+=$dbProduct->price;
        }
        $newOrder = $this->orderRepo->createOrder($request,$totalPrice);

        foreach ($cart as $product){
            $dbProduct = $this->productRepo->getSingleProduct($product["product_id"]);
            $products->push($dbProduct);
            $this->orderRepo->createOrderItems($newOrder,$product,$dbProduct);
        }
       return view("order", compact("newOrder","products"))->with("message","Your Order Was Successful.");
    }
    public function userOrders(){
        $orders = $this->orderRepo->getUserOrders();

        return view("user_orders", compact("orders"));
    }
}
