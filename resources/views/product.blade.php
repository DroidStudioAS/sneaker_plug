@extends("layouts.layout")
@section("content")
    <div class="single_product_card">
        <div class="first_product_row">
            <p>{{$singleProduct->category->name}}</p>
            <p>{{$singleProduct->price}}$</p>
        </div>
        <div class="second_product_row">
            <img class="product_image" src="{{asset("/res/mock.jpg")}}" alt="">
            <div class="product_information_permalink">
                <p>{{$singleProduct->Name}}</p>
                <p class="permalink_description">{{$singleProduct->description}}</p>
                <div class="review_container">
                    <img src="{{asset("/res/icon_rating.svg")}}" alt="" class="rating_star">
                    <img src="{{asset("/res/icon_rating.svg")}}" alt="" class="rating_star">
                    <img src="{{asset("/res/icon_rating.svg")}}" alt="" class="rating_star">
                    <img src="{{asset("/res/icon_rating.svg")}}" alt="" class="rating_star">

                </div>
                <p id="available_display">Only {{$totalAvailable}} Left. Available Sizes:</p>
                <div class="size_container">
                   @foreach($singleProduct->availableSizes as $size)
                       <div onclick="handleSizeButtonClick({{json_encode($size)}})" class="shoe_size">
                           {{$size->size}}
                       </div>
                   @endforeach
                </div>
            </div>
        </div>
        <div class="third_product_row">
            <div class="image_nav_container">
                <img  src="{{asset("/res/icon_left.svg")}}" alt="">
                <img  src="{{asset("/res/icon_right.svg")}}" alt="">
            </div>
            <div class="add_to_cart">
                Add To Cart
            </div>
        </div>
    </div>
    <script>
        function handleSizeButtonClick(availableSize){
            $("#available_display").text("Only " + availableSize.available + " Left in size "  +availableSize.size);
        }
    </script>
@endsection
