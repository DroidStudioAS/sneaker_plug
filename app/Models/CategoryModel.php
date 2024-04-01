<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table="product_categories";

    protected $fillable=["name"];

    public function categoryProducts(){
        return $this->hasMany(ProductModel::class, "category_id");
    }

}
