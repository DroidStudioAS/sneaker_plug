<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\ContactModel;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ContactController extends Controller{
    private $contactRepo;
    public function __construct(){
        $this->contactRepo = new ContactRepository();
    }
    public function index(){
        $messages = ContactModel::all();

        return view("admin.admin_dash", compact("messages"));
    }
    public function editMessage(ContactModel $contact, ContactRequest $request){
       $this->contactRepo->updateMessage($contact, $request);

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
