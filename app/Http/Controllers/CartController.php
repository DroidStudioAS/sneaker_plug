<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Models\ProductModel;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $productRepo;
    public function __construct(){
        $this->productRepo=new ProductRepository();
    }
    public function index(){
        $products= collect([]);
        $totalPriceOfCart=0;
        if (Session::get("products")===null){
            return view("checkout", compact("products","totalPriceOfCart"));
        }
        foreach (Session::get("products") as $orderArray){
            $product = $this->productRepo->getSingleProduct($orderArray["product_id"]);
            ProductHelper::addAmountAndSizeToProduct($product, $orderArray);
            $products->push($product);
            $totalPriceOfCart+= $product->amount * $product->price;
        }
        return view("checkout", compact("products","totalPriceOfCart"));
    }

    /****
     * @param ProductModel $product
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addToCart(ProductModel $product, Request $request){
        /* On the frontend we make sure the request does not have a larger amount then available
        * but just in case we will add validation
        */
        foreach ($product->availableSizes as $size){
            if ($size->size == $request->size){
                // Check if amount is larger
                if($size->available < $request->amount) {
                    return response(["failed" => true]);
                }
            }
        }

        // Prepare the cart item
        $cartItem = [
            "product_id" => $product->id,
            "amount" => $request->amount,
            "size" => $request->size
        ];
        // Add the cart item to the session
        Session::push("products", $cartItem);

        //Remove duplicate entries based on product_id and size
        $products = Session::get("products");
        $uniqueProducts = [];
        //reverse the array so that the most updated entry is rendered in cart
        foreach (array_reverse($products) as $product) {
            $key = $product['product_id'] . '-' . $product['size'];
            if (!array_key_exists($key, $uniqueProducts)) {
                $uniqueProducts[$key] = $product;
            }
        }

        Session::put("products", array_values($uniqueProducts));

        return response(["success" => true]);
    }
}
