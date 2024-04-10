<?php

namespace App\Repositories;

use App\Models\OrderItemsModel;
use App\Models\OrderModel;
use Illuminate\Support\Facades\Auth;

class OrderRepository{

    private $orderModel;
    private $orderItemModel;

    public function __construct()
    {
        $this->orderModel=new OrderModel();
        $this->orderItemModel=new OrderItemsModel();
    }
    public function createOrder($request, $totalPrice)
    {
        $this->orderModel = OrderModel::create([
            "user_id"=> Auth::check() ? Auth::id() : null,
            "contact_email"=>$request->contact_email,
            "contact_number"=>$request->contact_number,
            "payment_method"=>$request->payment_method,
            "status"=>"pending",
            "total_price"=>$totalPrice
        ]);
        return $this->orderModel;
    }

    public function createOrderItems($newOrder, $product, $dbProduct){
        $this->orderItemModel =  OrderItemsModel::create([
            "order_id"=>$newOrder->id,
            "product_id"=>$product["product_id"],
            "size"=>$product["size"],
            "amount"=>$product["amount"],
            "price"=>$dbProduct->price
        ]);
    }
    public function getUserOrders(){
        $orders = collect([]);
         if(Auth::check()){
           $orders=OrderModel::where(["user_id"=>Auth::id()])->get();
           $this->orderModel=$orders;
         }
         return $orders;
    }

}
