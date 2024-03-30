<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = "products_table";

    protected $fillable = ["category_id","Name","price","description","available_amount","image_name"];
}
