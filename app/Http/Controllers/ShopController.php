<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Repositories\ProductRepository;
use App\Repositories\SizeRepository;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $productRepo;
    private $sizeRepo;
    public function __construct(){
        $this->productRepo = new ProductRepository();
        $this->sizeRepo = new SizeRepository();
    }
    public function index(){
        $products = ProductModel::all();
        $categories = CategoryModel::all();
        return view("shop", compact("products", "categories"));
    }
    public function permalink($product){
        $singleProduct = $this->productRepo->getSingleProduct($product);
        $totalAvailable = $this->sizeRepo->getSizesForProduct($product);

        return view("product", compact("singleProduct", "totalAvailable"));
    }
    public function search(Request $request){
        //return arrays
        $categories = CategoryModel::all();
        $products= $this->productRepo->searchProducts($request->Name, $request->category_id, $request->price);
        //if any params related to size model are sent, run this loop.
        //else logic ends here and view is returned with the products and categories array
        $filteredProducts = collect([]);
        if($request->filled("size") || $request->filled("amount")){
             foreach ($products as $product){
                 foreach ($product->availableSizes as $size){
                     if($request->filled("size") && $request->filled("amount")){
                         if($size->size==$request->size && $size->available>=$request->amount){
                             $filteredProducts->push($product);
                         }
                     }
                     else if(!$request->filled("size") && $request->filled("amount")){
                         if($size->available>=$request->amount){
                             $filteredProducts->push($product);
                         }
                     }
                     else if($request->filled("size") && !$request->filled("amount")){
                         if($size->size==$request->size){
                             $filteredProducts->push($product);
                         }
                     }
                 }
             }
             //set products to filtered products for a single return block
            $products = $filteredProducts;
        }
        return view("shop", compact("products","categories"));

    }

}
