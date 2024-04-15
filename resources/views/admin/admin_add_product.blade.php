@extends("layouts.admin_layout")
@section("admin_content")
    <form class="add_form">
    <div id="basicInfo" class="basic_info">
        <h1>Enter Basic Product Information</h1>
        <select class="input_text">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <input type="text" class="input_text" name="Name">
        <input type="number" name="price" class="input_text">
        <textarea class="input_message"></textarea>
        <input type="file" name="image_name" id="" class="input_text">
        <div onclick="showNextForm()" class="input_submit" id="nextButton">Continue</div>
    </div>

    <div id="size_info" class="size_form">
        <h1>Add Available Sizes</h1>
        <input type="text" class="input_text">
        <div onclick="showLastForm()" class="input_submit" id="nextButton">Continue</div>
    </div>
    <div class="availability_form">
        <input type="number" name="" id="" class="input_text">
    </div>
    </form>
    <style>
        .add_form{
            display: flex;
            flex-flow: column nowrap;
            justify-content: flex-start;
            align-items: center;
        }
        .basic_info{
            position: relative;
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;
        }
        .size_form,.availability_form{
            width: 30vw;
            display: none;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;

            position: absolute;
            top: 300px;
            left: 2000px;
        }
    </style>
    <script>
        function showNextForm(){
            $(".basic_info").animate({
                right:2000
            },500);
            $(".size_form").css("display","flex").animate({
                left:"35vw"
            },500)
        }
        function showLastForm(){
            $(".size_form").animate({
                left:"-100vw",
            },500)
            $(".availability_form").css("display","flex").animate({
                left:"35vw"
            },500)
        }
    </script>
@endsection

