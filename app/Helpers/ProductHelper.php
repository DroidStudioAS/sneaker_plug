<?php

namespace App\Helpers;

use App\Models\ProductModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductHelper
{

    const MODELS = array(
        0 => array('category_id' => 1, 'name' => 'Ultra Boost', 'price' => 150, 'description' => 'The Ultra Boost is a versatile running shoe known for its comfort and responsiveness.'),
        1 => array('category_id' => 2, 'name' => 'Air Jordan 1', 'price' => 170, 'description' => 'The Air Jordan 1 is a classic basketball shoe that has become a cultural icon.'),
        2 => array('category_id' => 3, 'name' => 'Classic Leather', 'price' => 80, 'description' => 'The Classic Leather is a timeless sneaker that offers style and comfort for everyday wear.'),
        3 => array('category_id' => 4, 'name' => 'Air Force 1', 'price' => 120, 'description' => 'The Air Force 1 is a streetwear staple featuring iconic design elements and durable construction.'),
        4 => array('category_id' => 1, 'name' => 'NMD_R1', 'price' => 130, 'description' => 'The NMD_R1 combines style and performance with its sleek design and responsive cushioning.'),
        5 => array('category_id' => 2, 'name' => 'Air Max 90', 'price' => 120, 'description' => 'The Air Max 90 is a classic sneaker featuring Nike\'s signature Air cushioning for all-day comfort.'),
        6 => array('category_id' => 4, 'name' => 'Supreme x Nike SB Dunk Low', 'price' => 110, 'description' => 'The Supreme x Nike SB Dunk Low is a collaboration sneaker featuring unique design elements and premium materials.'),
        7 => array('category_id' => 3, 'name' => 'Nano X', 'price' => 100, 'description' => 'The Nano X is a versatile training shoe designed for high-intensity workouts.'),
        8 => array('category_id' => 1, 'name' => 'Yeezy Boost 350 V2', 'price' => 220, 'description' => 'The Yeezy Boost 350 V2 is a highly sought-after sneaker designed by Kanye West.'),
        9 => array('category_id' => 2, 'name' => 'Air Jordan 4', 'price' => 200, 'description' => 'The Air Jordan 4 is a legendary basketball shoe known for its iconic design and excellent cushioning.'),
        10 => array('category_id' => 3, 'name' => 'Pump Fury', 'price' => 160, 'description' => 'The Pump Fury is a futuristic sneaker featuring innovative Pump technology for a customized fit.'),
        11 => array('category_id' => 4, 'name' => 'Air Max 97', 'price' => 180, 'description' => 'The Air Max 97 is a classic Nike sneaker featuring full-length Max Air cushioning for lightweight comfort.'),
        12 => array('category_id' => 1, 'name' => 'Superstar', 'price' => 100, 'description' => 'The Superstar is an iconic Adidas sneaker known for its shell toe design and classic style.'),
        13 => array('category_id' => 2, 'name' => 'React Element 87', 'price' => 160, 'description' => 'The React Element 87 is a modern Nike sneaker featuring React foam cushioning for a lightweight and responsive feel.'),
        14 => array('category_id' => 3, 'name' => 'Zig Kinetica', 'price' => 130, 'description' => 'The Zig Kinetica is a performance-focused Reebok sneaker featuring Zig Energy Bands for enhanced cushioning and stability.'),
        15 => array('category_id' => 4, 'name' => 'Skateboard', 'price' => 90, 'description' => 'The Skateboard shoe is designed for skateboarding with durable materials and enhanced grip for better board control.'),
        16 => array('category_id' => 1, 'name' => 'Adilette', 'price' => 30, 'description' => 'The Adilette is a classic Adidas slide featuring a contoured footbed for comfort and iconic 3-Stripes design.'),
        17 => array('category_id' => 2, 'name' => 'Air Presto', 'price' => 120, 'description' => 'The Air Presto is a lightweight Nike sneaker featuring a stretchy mesh upper for a snug and flexible fit.'),
        18 => array('category_id' => 3, 'name' => 'Question Mid', 'price' => 140, 'description' => 'The Question Mid is a classic basketball shoe worn by Allen Iverson, featuring Hexalite cushioning for impact protection.'),
        19 => array('category_id' => 4, 'name' => 'Air Zoom Pegasus', 'price' => 120, 'description' => 'The Air Zoom Pegasus is a versatile Nike running shoe featuring Zoom Air cushioning for a responsive and smooth ride.'),
    );


    public static function addAmountAndSizeToProduct(ProductModel $product, $amountAndSize){
        //0-size 1-amount
        $product->amount = $amountAndSize["amount"];
        $product->size = $amountAndSize["size"];
    }
    public static function findSize($product, $sizeToFind){
        $sizes = collect([]);
        foreach ($product->availableSizes as $size){
            if($size->size===floatval($sizeToFind)){
               return $size;
            }
        }
        return false;
    }
    public static function buildImagePath($product){
        return asset("/res/product/$product->category_id") ."/". Str::slug($product->Name) . "/main.png";
    }
}
