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
        $this->sizeModel = AvailableSizes::where(["product_id"=>$id])->get();
        return $this->sizeModel;
    }
}
