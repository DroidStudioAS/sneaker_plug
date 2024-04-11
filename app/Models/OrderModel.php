<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table="orders";

    protected $fillable=["contact_email","contact_number","status","payment_method", "total_price",
                        "user_id", "delivery_address", "delivery_city_country", "postal_code"];

    public function items(){
        return $this->hasMany(OrderItemsModel::class,"order_id", "id");
    }

}
