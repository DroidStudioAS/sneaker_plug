<?php

namespace App\Helpers;

use App\Models\ProductModel;

class ProductHelper
{

    public static function addAmountToProduct(ProductModel $product, $amount){
        $product->amount = $amount;
    }
}
