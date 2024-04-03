@extends("layouts.layout")
@section("content")
    <div class="checkout_card">
        <div class="items_container">
            @if(count($products)===0)
                <p>You Have No Items In Your Cart</p>
            @else
            @foreach($products as $product)
                <div class="item">
                    <p class="item_info">{{$product->category->name}}  {{$product->Name}}</p>
                    <p class="item_info">{{$product->amount}}</p>
                    <p class="item_info">{{$product->price*$product->amount}}$</p>
                </div>
            @endforeach
            @endif
        <div class="item-total">
            <p class="item_info">Your Total Is</p>
            <p class="item_info">{{$sum}}$</p>
        </div>
        </div>
        <div class="payment_container">
            <p>Select A Payment Method</p>
            <div class="icon_container">
                <img src="{{asset("/res/icon_paypal.svg")}}" alt="">
                <img src="{{asset("/res/icon_apple.svg")}}" alt="">
            </div>
        </div>
    </div>
@endsection
