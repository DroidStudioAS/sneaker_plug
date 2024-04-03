@extends("layouts/layout")
@section("title") HomePage @endsection

@section("content")
    <div class="contact_container">
        <div class="contact_form">
            <h1>Contact Us</h1>
            @if(isset($message))
                <p>{{$message}}</p>
            @elseif($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{route("contact.send")}}" method="POST" class="form">
                {{csrf_field()}}
                <input type="text" placeholder="subject" name="subject" class="input_text">
                <input type="text" placeholder="email" name="email" class="input_text">
                <textarea type="text" placeholder="message" name="message" class="input_message">
                </textarea>
                <input type="submit" value="Send" class="input_submit">
            </form>
        </div>
        <div class="contact_additional">
            <p>Working Hours: 00/24</p>
            <p>Email: Mock@email.com</p>
            <p>Address: MockAdress@gmail.com</p>
            <div class="map_container">
                <iframe width="339" height="289" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=339&amp;height=289&amp;hl=en&amp;q=cara%20dusana%2044%20Belgrade+()&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> <a href='https://www.acadoo.de/'>Masterarbeit schreiben lassen</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=0c6609b104613a47508250ede17a4db3b20ba879'></script>
            </div>
        </div>
    </div>
@endsection
