@extends("layouts.layout")
@section("content")
    <div class="order_container">
        <h1>Thank You!</h1>
        <p>We Have Received Your Order, And It Will Be Delivered Within 4-7 Working Days</p>
        @if(\Illuminate\Support\Facades\Auth::check())
            You Can Follow The Status Of Your Orders Through The Orders Section Of Our Website
        @else
            In The Future, Create An Account To Follow Your Orders Directly From Our Website
        @endif
        <div class="order_info_container">
            <div class="order_details">
                <p>Your Order Id: <span class="order_info">{{$newOrder->id}}</span> </p>
                <p>Total Price: <span class="order_info">{{$newOrder->total_price}}</span> </p>
                <p>Status: <span class="order_info">{{$newOrder->status}}</span> </p>
            </div>
            <div class="order_items">
                <p class="order_info">You Ordered:</p>
                @foreach($products as $product)
                    <p>{{$product->category->name}} {{$product->Name}}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
