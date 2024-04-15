<?php

namespace App\Repositories;

use App\Models\AvailableSizes;

class SizeRepository
{
    private $sizeModel;

    public function  __construct(){
        $this->sizeModel = new AvailableSizes();
    }
    public function getSizesForProduct($id){
        $sum=0;
        $this->sizeModel = AvailableSizes::where(["product_id"=>$id])->get();
        foreach ($this->sizeModel as $size){
            $sum += $size->available;
        }
        return $sum;
    }
    public function createAvailableSize($product, $request){
        $this->sizeModel=AvailableSizes::create([
            "product_id"=>$product->id,
            "size"=>$request->size,
            "available"=>$request->available
        ]);
    }

}
