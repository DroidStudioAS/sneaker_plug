<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view("contact");
    }
    public function sendMessage(Request $request){
        $request->validate([
            "subject"=>"required|string",
            "email"=>"required|string",
            "message"=>"required|string"
        ]);

        $requestDate = $request->except("_token");

        ContactModel::create($requestDate);
        return view("/contact")->with("message", "Your Message Was Sent Successfully");
    }

}
