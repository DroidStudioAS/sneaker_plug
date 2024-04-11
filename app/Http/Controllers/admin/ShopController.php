<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\AvailableSizes;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    private $productRepo;
    private $categoryRepo;

    public function __construct(){
        $this->productRepo = new ProductRepository();
        $this->categoryRepo= new CategoryRepository();
    }

    public function index(){
        $products = ProductModel::all();
        $categories = CategoryModel::all();

        return view("admin.admin_products", compact("products","categories"));
    }

    //request is sent only for the csrf token;
    public function deleteProduct(ProductModel $product, Request $request){
        $this->productRepo->deleteProduct($product);

        return response([
            "success"=>true
        ]);
    }
    public function addProduct(ProductRequest $request){

        $this->productRepo->createNewProduct($request);

        return redirect()->back()->with("message","$request->Name Created successfully");
    }
    public function pushToEditProduct(ProductModel $product)
    {
        $categories = CategoryModel::all();
        return view("admin.edit_product", compact("product","categories"));
    }

    //todo: validate availability, refactor update to repo
    public function editProductSize(AvailableSizes $size, Request $request){
        $size->available=$request->available;
        $size->save();

        return response([
            "success"=>true
        ]);
    }
    //todo: validate request and refactor creation to repo
    public function addProductSize(ProductModel $product, Request $request){
        AvailableSizes::create([
           "product_id"=>$product->id,
            "size"=>$request->size,
            "available"=>$request->available
        ]);
        return redirect()->back();
    }
    public function editProduct(ProductModel $product, Request $request){
        $request->validate([
            "image_name"=>'required|mimes:png'
        ]);
        $file = $request->file('image_name');

        // Check if a file was uploaded
        if ($file) {
            // Define the directory where you want to store the file relative to the public folder
            // Define the directory where you want to store the file relative to the public folder
            $directory = public_path('res/product/') . $product->category_id ."/". Str::slug($product->Name);

            // Specify the filename (you may want to generate a unique filename)
            $filename = 'main.png';

            // Check if the file already exists
            $existingFilePath = $directory . '/' . $filename;
            if (File::exists($existingFilePath)) {
                // Delete the existing file
                File::delete($existingFilePath);
            }

            // Move the uploaded file to the specified directory with the specified filename
            $file->move($directory, $filename);
            // Now the file is stored in the public/res directory with the filename main.png
        }

    }
}
