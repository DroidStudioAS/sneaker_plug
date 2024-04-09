<?php

namespace App\Repositories;

use App\Models\OrderModel;
use Illuminate\Support\Facades\Auth;

class OrderRepository{

    private $orderModel;

    public function __construct()
    {
        $this->orderModel=new OrderModel();
    }
    public function createOrder($request, $totalPrice)
    {
        $order = OrderModel::create([
            "user_id"=> Auth::check() ? Auth::id() : null,
            "contact_email"=>$request->contact_email,
            "contact_number"=>$request->contact_number,
            "payment_method"=>$request->payment_method,
            "status"=>"pending",
            "total_price"=>$totalPrice
        ]);
        return $order;
    }

}
