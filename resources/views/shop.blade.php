@extends("layouts/layout")
@section("title") HomePage @endsection

@section("content")
    <div class="product_container">

    @foreach($products as $product)
        <div class="product_card">
            <div class="product_content">
                <div class="product_image_container">
                    <img src="{{asset("/res/mock.jpg")}}" alt="product_image">
                </div>
                <div class="product_data_short">
                    <div class="product_name_desc_container">
                        <p class="product_name">{{$product->category->name}} {{$product->Name}}</p>
                        <p class="product_desc">{{$product->description}}</p>
                    </div>
                    <p>{{$product->price}}$</p>
                </div>
            </div>
            <div class="action_buttons">
                <img id="add_to_cart_button" src="{{asset("/res/icon_cart.svg")}}" alt="add to cart" class="action_button">
                <img id="more_info_button" src="{{asset("/res/icon_info.svg")}}" alt="more info" class="action_button"
                onclick="window.location='{{route('product.permalink',['product'=>$product->id])}}'">
            </div>
        </div>
    @endforeach
    </div>
    <script>

    </script>
@endsection
