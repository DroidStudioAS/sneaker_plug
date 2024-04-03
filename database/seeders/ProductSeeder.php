<?php

namespace Database\Seeders;

use App\Helpers\ProductHelper;
use App\Models\AvailableSizes;
use App\Models\ProductModel;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * seeds database with 20 generic shoe models
     */
    public function run()
    {
        $this->command->getOutput()->progressStart(20);
        foreach (ProductHelper::MODELS as $model){
            $tempSize = 0;
            $product = ProductModel::create([
                "category_id"=>$model["category_id"],
                "Name"=>$model["name"],
                "price"=>$model["price"],
                "description"=>$model["description"],
                "image_name"=>"mock.jpg"
            ]);
            for($i=0; $i<3; $i++){
                AvailableSizes::create([
                    "product_id"=>$product->id,
                    "size"=>rand(40,49),
                    "available"=>rand(0,100)
                ]);
            }
            $this->command->getOutput()->progressAdvance(1);
        }
        $this->command->getOutput()->progressFinish();
    }
}
