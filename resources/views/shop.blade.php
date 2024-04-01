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
                    <p class="product_desc">{{$product->description}}</p>
                    <p>{{$product->price}}$</p>
                </div>
            </div>
            <div class="action_buttons">

            </div>
        </div>
    @endforeach
    </div>
@endsection
