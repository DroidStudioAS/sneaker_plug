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
                <p>Only {{$singleProduct->available_amount}} Left. Available Sizes:</p>
                <div class="size_container">
                    <div class="shoe_size">40</div>
                    <div class="shoe_size">41</div>
                    <div class="shoe_size">42</div>
                    <div class="shoe_size">43</div>
                    <div class="shoe_size">44</div>
                    <div class="shoe_size">45</div>
                    <div class="shoe_size">46</div>
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
@endsection
