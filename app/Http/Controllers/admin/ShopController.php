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
use Illuminate\Support\Facades\Storage;
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
        $request->validate([
           "available"=>"required|int|gte:1"
        ]);
        $size->available=$request->available;
        $size->save();

        return response([
            "success"=>true,
            "message"=>"Size Updated"
        ]);
    }
    //todo: validate request and refactor creation to repo
    public function addProductSize(ProductModel $product, Request $request){
        $request->validate([
           "size"=>"required|numeric|gte:29",
            "available"=>"required|int|gte:1"
        ]);
        AvailableSizes::create([
                   "product_id"=>$product->id,
                    "size"=>$request->size,
                    "available"=>$request->available
                ]);
        return redirect()->back()->with("message_size", "Size Added");
    }
    public function editProduct(ProductModel $product, Request $request){
        $request->validate([
            "category_id"=>"required|int",
            "Name"=>"required|string",
            "price"=>"required|numeric",
            "description"=>"required|string",
            "image_name"=>'nullable|mimes:png'
        ]);
        $file = $request->file('image_name');
        // Check if a file was uploaded
        if ($file) {
            // Define the directory where you want to store the file relative to the storage folder
            $directory = 'res/product/' . $product->id ."/". Str::slug($product->Name);

            // Specify the filename (you may want to generate a unique filename)
            $filename = 'main.png';

            // Check if the file already exists
            $existingFilePath = $directory . '/' . $filename;
            if (Storage::disk('public')->exists($existingFilePath)) {
                // Delete the existing file
                Storage::disk('public')->delete($existingFilePath);
            }

            // Store the uploaded file in the specified directory with the specified filename
            Storage::disk('public')->putFileAs($directory, $file, $filename);
        }
        $product->update($request->except("image_name","_token"));
        return redirect()->back()->with("message_product", "Product Updated");
    }

}
