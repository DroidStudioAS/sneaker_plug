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
        $sizeSent = false;
        $amountSent = false;
        $products= ProductModel::where("Name", "LIKE", "%$request->Name%")
            ->where(["category_id"=>$request->category_id])
            ->where("price", "<=" ,$request->price)
            ->get();

        if($request->size!==null){
            $sizeSent=true;
            if($request->amount!==null){
                $amountSent=true;
            }
        }
        $filteredProducts = collect([]);

            foreach ($products as $product){
                foreach ($product->availableSizes as $size){
                    if($sizeSent && $amountSent){
                        if($size->size==$request->size && $size->available>=$request->amount){
                            $filteredProducts->push($product);
                        }
                    }
                    else if(!$sizeSent && $amountSent){
                        if($size->available>=$request->amount){
                            $filteredProducts->push($product);
                        }
                    }
                    else if($sizeSent && !$amountSent){
                        if($size->size==$request->size){
                            $filteredProducts->push($product);
                        }
                    }
                }
            }
        dd($filteredProducts);

    }

}
