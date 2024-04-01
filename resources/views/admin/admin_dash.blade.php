@extends("layouts.admin_layout")
@section("admin_content")
@foreach($messages as $message)
   <div class="message_card">
       <p class="message_field">{{$message->subject}}</p>
       <p class="message_field">{{$message->email}}</p>
       <p class="message_field">{{$message->message}}</p>
       <div class="button_container">
           <button></button>
           <button></button>
       </div>
   </div>
@endforeach
@endsection

