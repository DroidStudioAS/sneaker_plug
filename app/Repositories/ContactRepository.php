<?php

namespace App\Repositories;

use App\Models\ContactModel;

class ContactRepository
{
    private $contactModel;
    public function __construct(){
        $this->contactModel=new ContactModel();
    }
    public function sendMessage($request){
        $this->contactModel= ContactModel::create($request->except("_token"));
    }
    public function updateMessage($contact, $request){
         $contact->update($request->except("_token"));
    }
}
