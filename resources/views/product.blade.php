@extends("layouts.layout")
@section("content")
    <div class="single_product_card">
        <div class="first_product_row">
            Brand Name
        </div>
        <div class="second_product_row">
            <img class="product_image" src="{{asset("/res/mock.jpg")}}" alt="">
            <div class="product_information_permalink">
                <p>Product Name</p>
                <p class="permalink_description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus et impedit laudantium magni reprehenderit sed sunt suscipit ullam vero. Ad adipisci amet asperiores beatae consectetur cum debitis dignissimos dolor dolorem exercitationem explicabo fugiat hic maxime nemo nisi nulla numquam, optio perspiciatis possimus praesentium provident ratione sequi tenetur totam ullam vitae.</p>
                <div class="review_container">
                    <img src="{{asset("/res/icon_rating.svg")}}" alt="" class="rating_star">
                    <img src="{{asset("/res/icon_rating.svg")}}" alt="" class="rating_star">
                    <img src="{{asset("/res/icon_rating.svg")}}" alt="" class="rating_star">
                    <img src="{{asset("/res/icon_rating.svg")}}" alt="" class="rating_star">

                </div>
                <p>Available Sizes:</p>
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
