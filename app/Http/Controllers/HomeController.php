<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public static function index()
    {
        $featuredProducts = ProductModel::latest()->take(6)->get();

        //return value
        return view("welcome", compact("featuredProducts"));
    }
}
