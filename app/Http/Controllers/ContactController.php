<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactModel;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contactRepo;
    public function __construct(){
        $this->contactRepo=new ContactRepository();
    }
    public function index(){
        return view("contact");
    }
    public function sendMessage(ContactRequest $request){
        $this->contactRepo->sendMessage($request);
        return view("/contact")->with("message", "Your Message Was Sent Successfully");
    }

}
