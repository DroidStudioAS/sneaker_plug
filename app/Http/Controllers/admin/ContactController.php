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
    public function editMessage(ContactModel $contact, Request $request){
        $request->validate([
            "email"=>"required|string",
            "subject"=>"required|string",
            "message"=>"required|string"
        ]);

        $contact->subject = $request->subject;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        return response([
            "success"=>true
        ]);
    }
    public function deleteMessage(ContactModel $contact){
        $contact->delete();
        return response([
            "success"=>true
        ]);

    }
}
