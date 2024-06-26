@extends("layouts.admin_layout")
@section("admin_content")
@foreach($messages as $message)
   <div class="message_card">
       <p class="message_field">Subject: {{$message->subject}}</p>
       <p class="message_field">From: {{$message->email}}</p>
       <p class="message_field">"{{$message->message}}"</p>
       <div class="button_container">
           <button onclick="showEditPopup({{json_encode($message)}})" class="edit_button">Edit</button>
           <button onclick="deleteMessage({{json_encode($message)}})" class="delete_button">Delete</button>
       </div>
   </div>
@endforeach

<div class="edit_msg_popup">
    <img class="close_button" src="{{asset("/res/close.png")}}" alt="close_button" onclick="closeEditPopup()">
    <form action="" class="form">
        {{csrf_field()}}
        <input id="edit_subject" type="text" class="input_text">
        <input id="edit_email" type="text" class="input_text">
        <textarea id="edit_msg"  class="input_message">
        </textarea>
        <input id="edit_submit" type="submit" class="input_submit">
    </form>
</div>
    <script>
        function showEditPopup(message){
            console.log(message)
            $(".edit_msg_popup").css("display","flex");
            //set field values
            $("#edit_subject").val(message.subject);
            $("#edit_email").val(message.email);
            $("#edit_msg").val(message.message);

            $("#edit_submit").off("click").on("click", function (e){
                e.preventDefault();
                editMessage(message);
            })
        }

        function closeEditPopup(){
            $(".edit_msg_popup").css("display","none");
        }

        function editMessage(message){
           $.ajax({
               url:"/admin/contact/edit/"+message.id,
               type:"POST",
               data: {
                   "_token": $('meta[name="csrf-token"]').attr('content'),
                   "subject": $("#edit_subject").val(),
                   "email":$("#edit_email").val(),
                   "message":$("#edit_msg").val()
               },
               success:function (response){
                   if(response.success===true){
                       location.reload();
                   }
               }
           })
        }
        function deleteMessage(message){
            $.ajax({
                url:"/admin/contact/delete/"+message.id,
                type:"POST",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                },
                success:function (response){
                    if(response.success===true){
                        location.reload();
                    }
                }
            })
        }


    </script>
@endsection

