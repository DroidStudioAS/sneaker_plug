<?php

namespace App\Repositories;

use App\Models\CategoryModel;

class CategoryRepository{
    private $categoryModel;

    public function __construct(){
        $this->categoryModel=new CategoryModel();
    }
    public function getAllCategories(){
        $this->categoryModel = CategoryModel::all();
        return $this->categoryModel;
    }

}
