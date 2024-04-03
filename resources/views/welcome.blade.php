@extends("layouts/layout")
@section("title") HomePage @endsection

@section("content")
    <h1>Featured Models</h1>
    <div class="product_container">


    @foreach($featuredProducts as $product)
        <div class="product_card">
            <div class="product_content">
                <div class="product_image_container">
                    <img src="{{asset("/res/mock.jpg")}}" alt="product_image">
                </div>
                <div class="product_data_short">
                    <p class="product_desc">{{$product->description}}</p>
                    <p>{{$product->price}}$</p>
                </div>
            </div>
            <div class="action_buttons">
                <img id="add_to_cart_button" src="{{asset("/res/icon_cart.svg")}}" alt="add to cart" class="action_button">
                <img onclick="window.location='{{route('product',['product'=>$product->id])}}'"
                    id="more_info_button" src="{{asset("/res/icon_info.svg")}}" alt="more info" class="action_button">
            </div>
        </div>
    @endforeach
    </div>
@endsection
