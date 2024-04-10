<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemsModel extends Model
{
    protected $table="order_items";

    protected $fillable=["order_id","product_id","size","amount","price"];

    public function product()
    {
        return $this->hasOne(ProductModel::class, "id", "product_id");
    }
}
