<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = "products_table";

    protected $fillable = ["category_id","Name","price","description","available_amount","image_name"];

    public function category(){
        return $this->hasOne(CategoryModel::class,"id", "category_id");
    }
    public function availableSizes(){
        return $this->hasMany(AvailableSizes::class, "product_id", "id");
    }
}
