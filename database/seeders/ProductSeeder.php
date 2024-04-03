<?php

namespace Database\Seeders;

use App\Helpers\ProductHelper;
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
            ProductModel::create([
                "category_id"=>$model["category_id"],
                "Name"=>$model["name"],
                "price"=>$model["price"],
                "description"=>$model["description"],
                "available_amount"=>rand(0,100),
                "image_name"=>"mock.jpg"
            ]);

            $this->command->getOutput()->progressAdvance(1);
        }
        $this->command->getOutput()->progressFinish();
    }
}
