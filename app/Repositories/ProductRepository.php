<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Models\ProductModel;
use http\Env\Request;

class ProductRepository{

    private $productModel;

    public function __construct(){
        $this->productModel = new ProductModel();
    }
   public function createNewProduct(ProductRequest $request){
        $this->productModel->create($request->except("_token"));
   }
   public function editProduct($product, $request){
       $product->update($request->except("_token"));
   }
   public function getAllProducts(){
        $this->productModel=ProductModel::all();
        return $this->productModel;
   }
   public function deleteProduct($product){
       $product->delete();
   }
   public function getLatestProducts($numOfProducts){
        $this->productModel =ProductModel::latest()->take($numOfProducts)->get();
        return $this->productModel;
   }
   public function getSingleProduct($productId){
        $this->productModel = ProductModel::where(["id"=>$productId])->first();
        return $this->productModel;
   }


}
