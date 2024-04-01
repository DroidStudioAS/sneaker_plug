<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactModel;
use Illuminate\Http\Request;

class ContactController extends Controller{
    public function index(){
        $messages = ContactModel::all();

        return view("admin.admin_dash", compact("messages"));
    }
}
