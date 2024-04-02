<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $productRepo;
    public function __construct()
    {
        $this->productRepo=new ProductRepository();
    }
    public function index()
    {
        $featuredProducts = $this->productRepo->getLatestProducts(6);
        //return value
        return view("welcome", compact("featuredProducts"));
    }
}
