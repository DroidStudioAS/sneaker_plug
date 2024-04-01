@extends("layouts.admin_layout")
@section("admin_content")
@foreach($messages as $message)
   <div class="message_card">
       <p class="message_field">Subject: {{$message->subject}}</p>
       <p class="message_field">From: {{$message->email}}</p>
       <p class="message_field">"{{$message->message}}"</p>
       <div class="button_container">
           <button class="edit_button">Edit</button>
           <button class="delete_button">Delete</button>
       </div>
   </div>
@endforeach
@endsection
